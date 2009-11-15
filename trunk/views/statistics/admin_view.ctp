<div class="statistics view">
<h2><?php  __('Statistic');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statistic['Statistic']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Team'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($statistic['Team']['name'], array('controller'=> 'teams', 'action'=>'view', $statistic['Team']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Matches'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statistic['Statistic']['matches']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Maps'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statistic['Statistic']['maps']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Won'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statistic['Statistic']['won']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lost'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statistic['Statistic']['lost']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Frags'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statistic['Statistic']['frags']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Deaths'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statistic['Statistic']['deaths']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Events'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statistic['Statistic']['events']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Statistic', true), array('action'=>'edit', $statistic['Statistic']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Statistic', true), array('action'=>'delete', $statistic['Statistic']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $statistic['Statistic']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Statistics', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Statistic', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Teams', true), array('controller'=> 'teams', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Team', true), array('controller'=> 'teams', 'action'=>'add')); ?> </li>
	</ul>
</div>
