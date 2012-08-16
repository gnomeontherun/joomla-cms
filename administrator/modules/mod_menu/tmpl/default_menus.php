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

require_once(JPATH_ADMINISTRATOR.'/components/com_menus/models/menus.php');
$model = new MenusModelMenus();
$menus = $model->getItems();

?>

<?php for ($i = 0; $i < count($menus); $i++) : ?>
<?php if ($i > 0 ) : ?><li><?php endif; ?>
    <a href="<?php echo JRoute::_('index.php?option=com_menus&view=items&menutype='.$menus[$i]->menutype); ?>" title="<?php echo $menus[$i]->title; ?>">
		<?php echo $menus[$i]->title; ?> (<?php echo JText::_(($menus[$i]->client_id) ? 'JADMINISTRATOR' : 'JSITE'); ?>)
	</a>
<?php if ($i < count($menus) + 1) : ?></li><?php endif; ?>
<?php endfor; ?>
