<div class="matches index">
<h2><?php __('Matches');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('team1_id');?></th>
	<th><?php echo $paginator->sort('team2_id');?></th>
	<th><?php echo $paginator->sort('event_id');?></th>
	<th><?php echo $paginator->sort('tposition_x');?></th>
	<th><?php echo $paginator->sort('tposition_y');?></th>
	<th><?php echo $paginator->sort('playofftable_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($matches as $match):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $match['Match']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($match['Team1']['name'], array('controller'=> 'teams', 'action'=>'view', $match['Team1']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($match['Team2']['name'], array('controller'=> 'teams', 'action'=>'view', $match['Team2']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($match['Event']['name'], array('controller'=> 'events', 'action'=>'view', $match['Event']['id'])); ?>
		</td>
		<td>
			<?php echo $match['Match']['tposition_x']; ?>
		</td>
		<td>
			<?php echo $match['Match']['tposition_y']; ?>
		</td>
		<td>
			<?php echo $html->link($match['Playofftable']['name'], array('controller'=> 'playofftables', 'action'=>'view', $match['Playofftable']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $match['Match']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $match['Match']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $match['Match']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $match['Match']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Match', true), array('action'=>'add')); ?></li>
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
