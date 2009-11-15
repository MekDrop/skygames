<div class="teamplayers view">
<h2><?php  __('Teamplayer');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $teamplayer['Teamplayer']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $teamplayer['Teamplayer']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mail'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $teamplayer['Teamplayer']['mail']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Skype'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $teamplayer['Teamplayer']['skype']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Uniqueid'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $teamplayer['Teamplayer']['uniqueid']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Team'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($teamplayer['Team']['name'], array('controller'=> 'teams', 'action'=>'view', $teamplayer['Team']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Teamplayer', true), array('action'=>'edit', $teamplayer['Teamplayer']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Teamplayer', true), array('action'=>'delete', $teamplayer['Teamplayer']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $teamplayer['Teamplayer']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Teamplayers', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Teamplayer', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Teams', true), array('controller'=> 'teams', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Team', true), array('controller'=> 'teams', 'action'=>'add')); ?> </li>
	</ul>
</div>
