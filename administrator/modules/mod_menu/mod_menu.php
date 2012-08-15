<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the module helper classes.
if (!class_exists('ModMenuHelper'))
{
	require __DIR__ . '/helper.php';
}

if (!class_exists('JAdminCssMenu')) {
	require dirname(__FILE__).'/menu.php';
}

if (!class_exists('JMenuAdministrator')) {
	require JPATH_ADMINISTRATOR . '/includes/menu.php';
}

// Initialise variables.
$lang    = JFactory::getLanguage();
$user    = JFactory::getUser();
$input   = JFactory::getApplication()->input;

$disabled = $input->getBool('hidemainmenu') ? false : true;
$menu = JMenu::getInstance('administrator');
$active = $menu->getActive();
$active_id = isset($active) ? $active->id : $menu->getDefault()->id;

$list 	 = modMenuHelper::getList($params);

// Render the module layout
require JModuleHelper::getLayoutPath('mod_menu', $params->get('layout', 'default'));
