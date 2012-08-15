<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
$class = ((strpos($item->img, 'class:') === 0) ? 'class="disabled icon-16-'. str_replace('class:', '', $item->img).'"' : 'class="disabled" style="background-image: url('.$item->img.');"');
?>
<a <?php echo $class; ?>href="<?php echo $item->flink; ?>" title="<?php echo JText::_($item->title); ?>"><?php echo JText::_($item->title); ?></a>
