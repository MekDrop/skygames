<div class="resultdemos index">
<h2><?php __('Resultdemos');?></h2>
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
	<th><?php echo $paginator->sort('desc');?></th>
	<th><?php echo $paginator->sort('url');?></th>
	<th><?php echo $paginator->sort('result_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($resultdemos as $resultdemo):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $resultdemo['Resultdemo']['id']; ?>
		</td>
		<td>
			<?php echo $resultdemo['Resultdemo']['title']; ?>
		</td>
		<td>
			<?php echo $resultdemo['Resultdemo']['desc']; ?>
		</td>
		<td>
			<?php echo $resultdemo['Resultdemo']['url']; ?>
		</td>
		<td>
			<?php echo $html->link($resultdemo['Result']['id'], array('controller'=> 'results', 'action'=>'view', $resultdemo['Result']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $resultdemo['Resultdemo']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $resultdemo['Resultdemo']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $resultdemo['Resultdemo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $resultdemo['Resultdemo']['id'])); ?>
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
		<li><?php echo $html->link(__('New Resultdemo', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Results', true), array('controller'=> 'results', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add')); ?> </li>
	</ul>
</div>
