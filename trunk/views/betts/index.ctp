<div class="betts index">
<h2><?php __('Betts');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('match_id');?></th>
	<th><?php echo $paginator->sort('team_id');?></th>
	<th><?php echo $paginator->sort('sum');?></th>
	<th><?php echo $paginator->sort('odds');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($betts as $bett):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $bett['Bett']['id']; ?>
		</td>
		<td>
			<?php echo $bett['Bett']['match_id']; ?>
		</td>
		<td>
			<?php echo $bett['Bett']['team_id']; ?>
		</td>
		<td>
			<?php echo $bett['Bett']['sum']; ?>
		</td>
		<td>
			<?php echo $bett['Bett']['odds']; ?>
		</td>
		<td>
			<?php echo $bett['Bett']['user_id']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $bett['Bett']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $bett['Bett']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $bett['Bett']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $bett['Bett']['id'])); ?>
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
		<li><?php echo $html->link(__('New Bett', true), array('action'=>'add')); ?></li>
	</ul>
</div>
