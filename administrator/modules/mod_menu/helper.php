<?php
/**
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

/**
 * @package		Joomla.Administrator
 * @subpackage	mod_menu
 * @since		1.5
 */
class modMenuHelper
{
	/**
	 * Get a list of the menu items.
	 *
	 * @param	JRegistry	$params	The module options.
	 *
	 * @return	array
	 * @since	1.5
	 */
	static function getList($params, $disabled = false)
	{
		$user = JFactory::getUser();
		$levels = $user->getAuthorisedViewLevels();
		asort($levels);
		$key = 'menu_items'.implode(',', $levels);
		$cache = JFactory::getCache('mod_menu', '');
		$lang = JFactory::getLanguage();
		$items = $cache->get($key);
		if (!$items)
		{
			// Initialise variables.
			$list		= array();
			$db			= JFactory::getDbo();
			$user		= JFactory::getUser();
			$app		= JFactory::getApplication();
			$menu		= JMenu::getInstance('administrator');

			// If no active menu, use default
			$active = ($menu->getActive()) ? $menu->getActive() : $menu->getDefault();

			$path		= $active->tree;
			$start		= 0;
			$end		= ($disabled) ? false : true;
			$showAll	= ($disabled) ? false : true;
			$maxdepth	= false;
			$items 		= $menu->getItems('menutype', $params->get('menutype', 'admin'));

			$lastitem	= 0;

			if ($items) {
				foreach($items as $i => $item)
				{
					// @TODO Handle subitems with access when parent items are not accessible by the user
                    if (isset($item->component) && !$user->authorise('core.manage', $item->component))
                    {
                        unset($items[$i]);
                        continue;
                    }

                    // Need to run a few hard checks because Joomla does
                    if (isset($item->component) && ($item->component == 'com_config' || $item->component == 'com_admin'))
                    {
                        if (!$user->authorise('core.admin', 'com_admin'))
                        {
                            unset($items[$i]);
                            continue;
                        }
                    }

					if (($start && $start > $item->level)
						|| ($end && $item->level > $end)
						|| (!$showAll && $item->level > 1 && !in_array($item->parent_id, $path))
						|| ($maxdepth && $item->level > $maxdepth)
						|| ($start > 1 && !in_array($item->tree[$start-2], $path))
					) {
						unset($items[$i]);
						continue;
					}

                    if ($item->component) {
                        $lang->load($item->component.'.sys', JPATH_ADMINISTRATOR);
						$lang->load($item->component.'.sys', JPATH_ADMINISTRATOR.'/components/'.$item->component);
                        $lang->load($item->component.'.menu', JPATH_ADMINISTRATOR);
						$lang->load($item->component.'.menu', JPATH_ADMINISTRATOR.'/components/'.$item->component);
                    }

					$item->deeper = false;
					$item->shallower = false;
					$item->level_diff = 0;

					if (isset($items[$lastitem])) {
						$items[$lastitem]->deeper		= ($item->level > $items[$lastitem]->level);
						$items[$lastitem]->shallower	= ($item->level < $items[$lastitem]->level);
						$items[$lastitem]->level_diff	= ($items[$lastitem]->level - $item->level);
					}

					$item->parent = (boolean) $menu->getItems('parent_id', (int) $item->id, true);

					$lastitem			= $i;
					$item->active		= false;
					$item->flink = $item->link;

					if (strcasecmp(substr($item->flink, 0, 4), 'http') && (strpos($item->flink, 'index.php?') !== false)) {
						$item->flink = JRoute::_($item->flink, true, $item->params->get('secure'));
					}
					else {
						$item->flink = JRoute::_($item->flink);
					}

					$item->title = htmlspecialchars($item->title);
					$item->anchor_css = htmlspecialchars($item->params->get('menu-anchor_css', ''));
					$item->anchor_title = htmlspecialchars($item->params->get('menu-anchor_title', ''));
					$item->menu_image = $item->params->get('menu_image', '') ? htmlspecialchars($item->params->get('menu_image', '')) : '';
				}

				if (isset($items[$lastitem])) {
					$items[$lastitem]->deeper		= (($start?$start:1) > $items[$lastitem]->level);
					$items[$lastitem]->shallower	= (($start?$start:1) < $items[$lastitem]->level);
					$items[$lastitem]->level_diff	= ($items[$lastitem]->level - ($start?$start:1));
				}
			}

			$cache->store($items, $key);
		}
		else
		{
			foreach ($items as $item)
			{
				if ($item->component) {
					$lang->load($item->component.'.sys', JPATH_ADMINISTRATOR);
					$lang->load($item->component.'.sys', JPATH_ADMINISTRATOR.'/components/'.$item->component);
					$lang->load($item->component.'.menu', JPATH_ADMINISTRATOR);
					$lang->load($item->component.'.menu', JPATH_ADMINISTRATOR.'/components/'.$item->component);
				}
			}
		}
		
		return $items;
	}
}