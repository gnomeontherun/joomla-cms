<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_menus
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<script type="text/javascript">
	setmenutype = function(type)
	{
		window.parent.Joomla.submitbutton('item.setType', type);
		window.parent.SqueezeBox.close();
	}
</script>

<h2 class="modal-title"><?php echo JText::_('COM_MENUS_TYPE_CHOOSE'); ?></h2>
<ul class="menu_types">
	<?php foreach ($this->types as $name => $list): ?>
	<li>
		<h4><?php echo JText::_($name) ;?>
		<ul>
			<?php foreach ($list as $item): ?>
			<li><a class="choose_type" href="#" title="<?php echo JText::_($item->description); ?>"
					onclick="javascript:setmenutype('<?php echo base64_encode(json_encode(array('id' => $this->recordId, 'title' => $item->title, 'request' => $item->request))); ?>')">
					<?php echo JText::_($item->title);?>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</li>
	<?php endforeach; ?>

	<li>
		<h4><?php echo JText::_('COM_MENUS_TYPE_SYSTEM'); ?></h4>
		<ul>
			<li><a class="choose_type" href="#" title="<?php echo JText::_('COM_MENUS_TYPE_EXTERNAL_URL_DESC'); ?>"
					onclick="javascript:setmenutype('<?php echo base64_encode(json_encode(array('id' => $this->recordId, 'title'=>'url'))); ?>')">
					<?php echo JText::_('COM_MENUS_TYPE_EXTERNAL_URL'); ?>
				</a>
			</li>
			<li><a class="choose_type" href="#" title="<?php echo JText::_('COM_MENUS_TYPE_ALIAS_DESC'); ?>"
					onclick="javascript:setmenutype('<?php echo base64_encode(json_encode(array('id' => $this->recordId, 'title'=>'alias'))); ?>')">
					<?php echo JText::_('COM_MENUS_TYPE_ALIAS'); ?>
				</a>
			</li>
			<li><a class="choose_type" href="#"  title="<?php echo JText::_('COM_MENUS_TYPE_SEPARATOR_DESC'); ?>"
					onclick="javascript:setmenutype('<?php echo base64_encode(json_encode(array('id' => $this->recordId, 'title'=>'separator'))); ?>')">
					<?php echo JText::_('COM_MENUS_TYPE_SEPARATOR'); ?>
				</a>
			</li>
			<li><a class="choose_type" href="#"  title="<?php echo JText::_('*Logout'); ?>"
					onclick="javascript:setmenutype('<?php echo base64_encode(json_encode(array('id' => $this->recordId, 'title'=>'logout'))); ?>')">
					<?php echo JText::_('*Logout'); ?>
				</a>
			</li>
			<li><a class="choose_type" href="#"  title="<?php echo JText::_('*Menu List'); ?>"
					onclick="javascript:setmenutype('<?php echo base64_encode(json_encode(array('id' => $this->recordId, 'title'=>'menus'))); ?>')">
					<?php echo JText::_('*Menu List'); ?>
				</a>
			</li>
			<li><a class="choose_type" href="#"  title="<?php echo JText::_('*Component List'); ?>"
					onclick="javascript:setmenutype('<?php echo base64_encode(json_encode(array('id' => $this->recordId, 'title'=>'componentlist'))); ?>')">
					<?php echo JText::_('*Component List'); ?>
				</a>
			</li>
		</ul>
	</li>
</ul>
