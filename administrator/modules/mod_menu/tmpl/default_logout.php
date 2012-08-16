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

?>

<a class="<?php echo implode(' ', $classes); ?>" href="<?php echo JRoute::_('index.php?option=com_login&task=logout&' . JSession::getFormToken() . '=1'); ?>" title="<?php echo JText::_($item->title); ?>" <?php echo implode(' ', $attribs); ?>>
	<?php echo JText::_($item->title); ?>
</a>
