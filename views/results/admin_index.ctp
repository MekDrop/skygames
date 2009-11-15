<div class="results index">
<h2><?php __('Results');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('team1_score');?></th>
	<th><?php echo $paginator->sort('team2_score');?></th>
	<th><?php echo $paginator->sort('matchpart_id');?></th>
	<th><?php echo $paginator->sort('match_id');?></th>
	<th><?php echo $paginator->sort('map_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($results as $result):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $result['Result']['id']; ?>
		</td>
		<td>
			<?php echo $result['Result']['team1_score']; ?>
		</td>
		<td>
			<?php echo $result['Result']['team2_score']; ?>
		</td>
		<td>
			<?php echo $html->link($result['Matchpart']['title'], array('controller'=> 'matchparts', 'action'=>'view', $result['Matchpart']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($result['Match']['id'], array('controller'=> 'matches', 'action'=>'view', $result['Match']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($result['Map']['title'], array('controller'=> 'maps', 'action'=>'view', $result['Map']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $result['Result']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $result['Result']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $result['Result']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $result['Result']['id'])); ?>
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
		<li><?php echo $html->link(__('New Result', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Matchparts', true), array('controller'=> 'matchparts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Matchpart', true), array('controller'=> 'matchparts', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Matches', true), array('controller'=> 'matches', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Match', true), array('controller'=> 'matches', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Maps', true), array('controller'=> 'maps', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Map', true), array('controller'=> 'maps', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Resultdemos', true), array('controller'=> 'resultdemos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Resultdemo', true), array('controller'=> 'resultdemos', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Resultpictures', true), array('controller'=> 'resultpictures', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Resultpicture', true), array('controller'=> 'resultpictures', 'action'=>'add')); ?> </li>
	</ul>
</div>
