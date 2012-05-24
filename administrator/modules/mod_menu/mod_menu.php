<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	mod_menu
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$disabled	= JRequest::getInt('hidemainmenu') ? true : false;
$list		= modMenuHelper::getList($params, $disabled);
$menu		= JMenu::getInstance('administrator');
$active		= $menu->getActive();
$active_id 	= isset($active) ? $active->id : $menu->getDefault()->id;

if(count($list)) {
	require JModuleHelper::getLayoutPath('mod_menu', 'default');
}