<div class="matchparts index">
<h2><?php __('Matchparts');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('game_id');?></th>
	<th><?php echo $paginator->sort('constant');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($matchparts as $matchpart):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $matchpart['Matchpart']['id']; ?>
		</td>
		<td>
			<?php echo $matchpart['Matchpart']['title']; ?>
		</td>
		<td>
			<?php echo $html->link($matchpart['Game']['name'], array('controller'=> 'games', 'action'=>'view', $matchpart['Game']['id'])); ?>
		</td>
		<td>
			<?php echo $matchpart['Matchpart']['constant']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $matchpart['Matchpart']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $matchpart['Matchpart']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $matchpart['Matchpart']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $matchpart['Matchpart']['id'])); ?>
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
		<li><?php echo $html->link(__('New Matchpart', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Results', true), array('controller'=> 'results', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add')); ?> </li>
	</ul>
</div>
