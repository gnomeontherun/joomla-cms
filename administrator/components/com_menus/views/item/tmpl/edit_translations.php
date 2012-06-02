<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_menus
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$titles = JFactory::getApplication()->getUserState('com_menus.edit.item.titles.languages');
if (count($titles) > 1) :
	echo JHtml::_('sliders.panel', JText::_('*Translations'), 'translations'); ?>
	<fieldset class="panelform">
		<ul class="adminformlist">
	<?php foreach ($titles as $title) :
		if (!$title['current']) : ?>
			<li>
				<label><?php echo $title['name']; ?></label>
				<input type="text" name="titles[<?php echo $title['tag']; ?>]" size="40" value="<?php echo $title['title']; ?>" />
			</li>
		<?php endif; ?>
	<?php endforeach; ?>
		</ul>
	</fieldset>
<?php endif; ?>