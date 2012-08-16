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
<a href="#" class="<?php echo implode(' ', $classes); ?>" <?php echo implode(' ', $attribs); ?>>
	<?php echo JText::_($item->title); ?>
</a>