<div class="uniqueids view">
<h2><?php  __('Uniqueid');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $uniqueid['Uniqueid']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($uniqueid['User']['name'], array('controller'=> 'users', 'action'=>'view', $uniqueid['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Game'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($uniqueid['Game']['name'], array('controller'=> 'games', 'action'=>'view', $uniqueid['Game']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Value'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $uniqueid['Uniqueid']['value']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Uniqueid', true), array('action'=>'edit', $uniqueid['Uniqueid']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Uniqueid', true), array('action'=>'delete', $uniqueid['Uniqueid']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $uniqueid['Uniqueid']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Uniqueids', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Uniqueid', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?> </li>
	</ul>
</div>
