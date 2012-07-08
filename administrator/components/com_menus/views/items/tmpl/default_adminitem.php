<?php
/**
 * @package		Joomla.Administrator
 * @subpackage	com_menus
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

$item = $this->current->item;
$i = $this->current->index;
$user		= JFactory::getUser();
$app		= JFactory::getApplication();
$userId		= $user->get('id');
$listOrder	= $this->escape($this->state->get('list.ordering'));
$listDirn	= $this->escape($this->state->get('list.direction'));
$ordering 	= ($listOrder == 'a.lft');
$canOrder	= $user->authorise('core.edit.state',	'com_menus');
$saveOrder 	= ($listOrder == 'a.lft' && $listDirn == 'asc');

$orderkey = array_search($item->id, $this->ordering[$item->parent_id]);
$canCreate	= $user->authorise('core.create',		'com_menus');
$canEdit	= $user->authorise('core.edit',			'com_menus');
$canCheckin	= $user->authorise('core.manage',		'com_checkin') || $item->checked_out==$user->get('id')|| $item->checked_out==0;
$canChange	= $user->authorise('core.edit.state',	'com_menus') && $canCheckin;
?>
<tr class="row<?php echo $i % 2; ?>">
	<td class="center">
		<?php echo JHtml::_('grid.id', $i, $item->id); ?>
	</td>
	<td>
		<?php echo str_repeat('<span class="gi">|&mdash;</span>', $item->level-1) ?>
		<?php if ($item->checked_out) : ?>
			<?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'items.', $canCheckin); ?>
		<?php endif; ?>
		<?php if ($canEdit) : ?>
			<a href="<?php echo JRoute::_('index.php?option=com_menus&task=item.edit&id='.(int) $item->id);?>">
				<?php echo $this->escape(JText::_($item->title)); ?></a>
		<?php else : ?>
			<?php echo $this->escape(JText::_($item->title)); ?>
		<?php endif; ?>
		<?php if (!empty($item->note)) : ?>
		<p class="smallsub" title="<?php echo $this->escape($item->path);?>">
			<?php echo str_repeat('<span class="gtr">|&mdash;</span>', $item->level-1) ?>
			<?php if ($item->type !='url') : ?>
				<?php if (!empty($item->note)) : ?>
					<?php echo JText::sprintf('JGLOBAL_LIST_ALIAS_NOTE', $this->escape($item->alias), $this->escape($item->note));?>
				<?php endif; ?>
			<?php elseif($item->type =='url' && $item->note) : ?>
				<?php echo JText::sprintf('JGLOBAL_LIST_NOTE', $this->escape($item->note));?>
			<?php endif; ?></p>
		<?php endif; ?>
	</td>
	<td class="center">
		<?php echo JHtml::_('MenusHtml.Menus.state', $item->published, $i, $canChange, 'cb'); ?>
	</td>
	<td class="order">
		<?php if ($canChange) : ?>
			<?php if ($saveOrder) : ?>
				<span><?php echo $this->pagination->orderUpIcon($i, isset($this->ordering[$item->parent_id][$orderkey - 1]), 'items.orderup', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
				<span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, isset($this->ordering[$item->parent_id][$orderkey + 1]), 'items.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
			<?php endif; ?>
			<?php $disabled = $saveOrder ?  '' : 'disabled="disabled"'; ?>
			<input type="text" name="order[]" size="5" value="<?php echo $orderkey + 1;?>" <?php echo $disabled ?> class="text-area-order" />
			<?php $originalOrders[] = $orderkey + 1; ?>
		<?php else : ?>
			<?php echo $orderkey + 1;?>
		<?php endif; ?>
	</td>
	<td class="center">
		<?php echo $this->escape($item->access_level); ?>
	</td>
	<td class="nowrap">
		<span title="<?php echo isset($item->item_type_desc) ? htmlspecialchars($this->escape($item->item_type_desc), ENT_COMPAT, 'UTF-8') : ''; ?>">
			<?php echo $this->escape(JText::_($item->item_type)); ?></span>
	</td>
	<td class="center">
		<?php if ($item->type == 'component') : ?>
			<?php if ($item->language=='*' || $item->home=='0'):?>
				<?php echo JHtml::_('jgrid.isdefault', $item->home, $i, 'items.', ($item->language != '*' || !$item->home) && $canChange);?>
			<?php elseif ($canChange):?>
				<a href="<?php echo JRoute::_('index.php?option=com_menus&task=items.unsetDefault&cid[]='.$item->id.'&'.JSession::getFormToken().'=1');?>">
					<?php echo JHtml::_('image', 'mod_languages/'.$item->image.'.gif', $item->language_title, array('title'=>JText::sprintf('COM_MENUS_GRID_UNSET_LANGUAGE', $item->language_title)), true);?>
				</a>
			<?php else:?>
				<?php echo JHtml::_('image', 'mod_languages/'.$item->image.'.gif', $item->language_title, array('title'=>$item->language_title), true);?>
			<?php endif;?>
		<?php endif; ?>
	</td>
	<?php if ($app->get('menu_associations', 0)):?>
	<td class="center">
		<?php if ($item->association):?>
			<?php echo JHtml::_('MenusHtml.Menus.association', $item->id);?>
		<?php endif;?>
	</td>
	<?php endif;?>
	<td class="center">
		<span title="<?php echo sprintf('%d-%d', $item->lft, $item->rgt);?>">
			<?php echo (int) $item->id; ?></span>
	</td>
</tr>