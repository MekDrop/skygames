<div class="feeds index">
<h2><?php __('Feeds');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('url');?></th>
	<th><?php echo $paginator->sort('show');?></th>
	<th><?php echo $paginator->sort('game_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($feeds as $feed):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $feed['Feed']['id']; ?>
		</td>
		<td>
			<?php echo $feed['Feed']['name']; ?>
		</td>
		<td>
			<?php echo $feed['Feed']['url']; ?>
		</td>
		<td>
			<?php echo $feed['Feed']['show']; ?>
		</td>
		<td>
			<?php echo $html->link($feed['Game']['name'], array('controller'=> 'games', 'action'=>'view', $feed['Game']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $feed['Feed']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $feed['Feed']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $feed['Feed']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $feed['Feed']['id'])); ?>
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
		<li><?php echo $html->link(__('New Feed', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?> </li>
	</ul>
</div>
