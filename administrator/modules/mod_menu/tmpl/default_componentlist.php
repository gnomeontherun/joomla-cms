<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

$component_params = new JRegistry();
$component_params->set('menutype', 'components');
$list = modMenuHelper::getList($component_params);

?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown" title="<?php echo JText::_($item->title); ?>">
	<?php echo JText::_($item->title); ?>
	<span class="caret"></span>
</a>
<ul class="dropdown-menu">
<?php foreach ($list as $i => $item) : ?>
	<li><a href="<?php echo $item->flink; ?>"><?php echo JText::_($item->title); ?></a></li>
<?php endforeach; ?>	
</ul>
