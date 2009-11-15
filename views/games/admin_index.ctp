<div class="games index">
<h2><?php __('Games');?></h2>
<p><?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $paginator->sort('id');?></th>
		<th><?php echo $paginator->sort('name');?></th>
		<th><?php echo $paginator->sort('icon');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($games as $game):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $game['Game']['id']; ?></td>
		<td><?php echo $game['Game']['name']; ?></td>
		<td><?php echo $game['Game']['icon']; ?></td>
		<td class="actions"><?php echo $html->link(__('View', true), array('action'=>'view', $game['Game']['id'])); ?>
		<?php echo $html->link(__('Edit', true), array('action'=>'edit', $game['Game']['id'])); ?>
		<?php echo $html->link(__('Delete', true), array('action'=>'delete', $game['Game']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $game['Game']['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
</div>
<div class="paging"><?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers();?> <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
<ul>
	<li><?php echo $html->link(__('New Game', true), array('action'=>'add')); ?></li>
	<li><?php echo $html->link(__('List Events', true), array('controller'=> 'events', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Event', true), array('controller'=> 'events', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Matchparts', true), array('controller'=> 'matchparts', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Matchpart', true), array('controller'=> 'matchparts', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Gamewords', true), array('controller'=> 'gamewords', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Gameword', true), array('controller'=> 'gamewords', 'action'=>'add')); ?>
	</li>
</ul>
</div>
