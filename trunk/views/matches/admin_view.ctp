<div class="matches view">
<h2><?php  __('Match');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $match['Match']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Team1'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($match['Team1']['name'], array('controller'=> 'teams', 'action'=>'view', $match['Team1']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Team2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($match['Team2']['name'], array('controller'=> 'teams', 'action'=>'view', $match['Team2']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Event'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($match['Event']['name'], array('controller'=> 'events', 'action'=>'view', $match['Event']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tposition X'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $match['Match']['tposition_x']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tposition Y'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $match['Match']['tposition_y']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Playofftable'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($match['Playofftable']['name'], array('controller'=> 'playofftables', 'action'=>'view', $match['Playofftable']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Match', true), array('action'=>'edit', $match['Match']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Match', true), array('action'=>'delete', $match['Match']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $match['Match']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Matches', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Match', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Events', true), array('controller'=> 'events', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Event', true), array('controller'=> 'events', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Teams', true), array('controller'=> 'teams', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Team1', true), array('controller'=> 'teams', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Playofftables', true), array('controller'=> 'playofftables', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Playofftable', true), array('controller'=> 'playofftables', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Results', true), array('controller'=> 'results', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Results');?></h3>
	<?php if (!empty($match['Result'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Team1 Score'); ?></th>
		<th><?php __('Team2 Score'); ?></th>
		<th><?php __('Matchpart Id'); ?></th>
		<th><?php __('Match Id'); ?></th>
		<th><?php __('Map Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($match['Result'] as $result):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $result['id'];?></td>
			<td><?php echo $result['team1_score'];?></td>
			<td><?php echo $result['team2_score'];?></td>
			<td><?php echo $result['matchpart_id'];?></td>
			<td><?php echo $result['match_id'];?></td>
			<td><?php echo $result['map_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'results', 'action'=>'view', $result['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'results', 'action'=>'edit', $result['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'results', 'action'=>'delete', $result['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $result['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
