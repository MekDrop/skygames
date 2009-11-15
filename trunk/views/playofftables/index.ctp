<div class="playofftables index">
<h3><?php __('Playofftables');?></h3>
</div>
<div>

<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('events_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($playofftables as $playofftable):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $playofftable['Playofftable']['id']; ?>
		</td>
		<td>
			<?php echo $playofftable['Playofftable']['name']; ?>
		</td>
		<td>
			<?php echo $html->link($playofftable['Event']['name'], array('controller'=> 'events', 'action'=>'view', $playofftable['Event']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $playofftable['Playofftable']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $playofftable['Playofftable']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $playofftable['Playofftable']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $playofftable['Playofftable']['id'])); ?>
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
		<li><?php echo $html->link(__('New Playofftable', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Events', true), array('controller'=> 'events', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Event', true), array('controller'=> 'events', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Matches', true), array('controller'=> 'matches', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Match', true), array('controller'=> 'matches', 'action'=>'add')); ?> </li>
	</ul>
</div>
