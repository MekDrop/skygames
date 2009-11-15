<div class="feeds view">
<h2><?php  __('Feed');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $feed['Feed']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $feed['Feed']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $feed['Feed']['url']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Show'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $feed['Feed']['show']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Game'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($feed['Game']['name'], array('controller'=> 'games', 'action'=>'view', $feed['Game']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Feed', true), array('action'=>'edit', $feed['Feed']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Feed', true), array('action'=>'delete', $feed['Feed']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $feed['Feed']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Feeds', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Feed', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?> </li>
	</ul>
</div>
