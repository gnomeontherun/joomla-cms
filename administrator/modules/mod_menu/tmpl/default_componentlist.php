<?php
/**
 * @package     Square One
 * @link        www.squareonecms.org
 * @copyright   Copyright 2011 Square One and Open Source Matters. All Rights Reserved.
 */

// No direct access.
defined('_JEXEC') or die;

// Manually load a new menu module with the component list
$module = new stdClass();
$module->id = 0;
$module->title = $item->title;
$module->module = 'mod_menu';
$module->position = '';
$module->content = '';
$module->showtitle = 0;
$module->params = '{"menutype":"components"}';
$module->menuid = 0;
$module->user = 0;
$module->name = '';
$module->style = '';

$class = ((strpos($item->img, 'class:') === 0) ? 'class="icon-16-'. str_replace('class:', '', $item->img).'"' : 'style="background-image: url('.$item->img.');"');

?>
<li><a href="#" <?php echo $class; ?>"><?php echo JText::_($item->title); ?></a>
	<?php echo JModuleHelper::renderModule($module); ?>
</li>