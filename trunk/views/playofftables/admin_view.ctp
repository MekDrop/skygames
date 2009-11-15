<div class="playofftables view">
<h2><?php  __('Playofftable');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $playofftable['Playofftable']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $playofftable['Playofftable']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Event'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($playofftable['Event']['name'], array('controller'=> 'events', 'action'=>'view', $playofftable['Event']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Playofftable', true), array('action'=>'edit', $playofftable['Playofftable']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Playofftable', true), array('action'=>'delete', $playofftable['Playofftable']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $playofftable['Playofftable']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Playofftables', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Playofftable', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Events', true), array('controller'=> 'events', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Event', true), array('controller'=> 'events', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Matches', true), array('controller'=> 'matches', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Match', true), array('controller'=> 'matches', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Matches');?></h3>
	<?php if (!empty($playofftable['Match'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Team1 Id'); ?></th>
		<th><?php __('Team2 Id'); ?></th>
		<th><?php __('Event Id'); ?></th>
		<th><?php __('Tposition X'); ?></th>
		<th><?php __('Tposition Y'); ?></th>
		<th><?php __('Playofftable Id'); ?></th>
		<th><?php __('Date'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($playofftable['Match'] as $match):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $match['id'];?></td>
			<td><?php echo $match['team1_id'];?></td>
			<td><?php echo $match['team2_id'];?></td>
			<td><?php echo $match['event_id'];?></td>
			<td><?php echo $match['tposition_x'];?></td>
			<td><?php echo $match['tposition_y'];?></td>
			<td><?php echo $match['playofftable_id'];?></td>
			<td><?php echo $match['date'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'matches', 'action'=>'view', $match['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'matches', 'action'=>'edit', $match['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'matches', 'action'=>'delete', $match['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $match['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Match', true), array('controller'=> 'matches', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
