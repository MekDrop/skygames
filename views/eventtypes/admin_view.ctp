<div class="eventtypes view">
<h2><?php  __('Eventtype');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $eventtype['Eventtype']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $eventtype['Eventtype']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Eventtype', true), array('action'=>'edit', $eventtype['Eventtype']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Eventtype', true), array('action'=>'delete', $eventtype['Eventtype']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $eventtype['Eventtype']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Eventtypes', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Eventtype', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Events', true), array('controller'=> 'events', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Event', true), array('controller'=> 'events', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Events');?></h3>
	<?php if (!empty($eventtype['Event'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Game Id'); ?></th>
		<th><?php __('Eventtype Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($eventtype['Event'] as $event):
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
