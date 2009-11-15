<div class="orgs view">
<h2><?php  __('Org');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $org['Org']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $org['Org']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($org['User']['name'], array('controller'=> 'users', 'action'=>'view', $org['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $org['Org']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Website'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $org['Org']['website']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Irc'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $org['Org']['irc']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Logo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $org['Org']['logo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Country Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $org['Org']['country_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Org', true), array('action'=>'edit', $org['Org']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Org', true), array('action'=>'delete', $org['Org']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $org['Org']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Orgs', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Org', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Events', true), array('controller'=> 'events', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Event', true), array('controller'=> 'events', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Events');?></h3>
	<?php if (!empty($org['Event'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Game Id'); ?></th>
		<th><?php __('Eventtype Id'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Teamcount'); ?></th>
		<th><?php __('Genmatches'); ?></th>
		<th><?php __('Regdate'); ?></th>
		<th><?php __('Startdate'); ?></th>
		<th><?php __('Matchinterval'); ?></th>
		<th><?php __('Desc'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Teamsize'); ?></th>
		<th><?php __('Org Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($org['Event'] as $event):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $event['id'];?></td>
			<td><?php echo $event['name'];?></td>
			<td><?php echo $event['game_id'];?></td>
			<td><?php echo $event['eventtype_id'];?></td>
			<td><?php echo $event['status'];?></td>
			<td><?php echo $event['created'];?></td>
			<td><?php echo $event['teamcount'];?></td>
			<td><?php echo $event['genmatches'];?></td>
			<td><?php echo $event['regdate'];?></td>
			<td><?php echo $event['startdate'];?></td>
			<td><?php echo $event['matchinterval'];?></td>
			<td><?php echo $event['desc'];?></td>
			<td><?php echo $event['user_id'];?></td>
			<td><?php echo $event['teamsize'];?></td>
			<td><?php echo $event['org_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'events', 'action'=>'view', $event['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'events', 'action'=>'edit', $event['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'events', 'action'=>'delete', $event['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $event['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Event', true), array('controller'=> 'events', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Users');?></h3>
	<?php if (!empty($org['Staff'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Points'); ?></th>
		<th><?php __('Username'); ?></th>
		<th><?php __('Passwd'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Last Visit'); ?></th>
		<th><?php __('Group Id'); ?></th>
		<th><?php __('Active'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('Skype'); ?></th>
		<th><?php __('Avatar Url'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($org['Staff'] as $staff):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $staff['id'];?></td>
			<td><?php echo $staff['points'];?></td>
			<td><?php echo $staff['username'];?></td>
			<td><?php echo $staff['passwd'];?></td>
			<td><?php echo $staff['name'];?></td>
			<td><?php echo $staff['email'];?></td>
			<td><?php echo $staff['last_visit'];?></td>
			<td><?php echo $staff['group_id'];?></td>
			<td><?php echo $staff['active'];?></td>
			<td><?php echo $staff['created'];?></td>
			<td><?php echo $staff['modified'];?></td>
			<td><?php echo $staff['skype'];?></td>
			<td><?php echo $staff['avatar_url'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'users', 'action'=>'view', $staff['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'users', 'action'=>'edit', $staff['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'users', 'action'=>'delete', $staff['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $staff['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Staff', true), array('controller'=> 'users', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
