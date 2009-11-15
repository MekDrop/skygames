<div class="threadcats index">
<h2><?php __('Threadcats');?></h2>
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
	<th><?php echo $paginator->sort('game_id');?></th>
	<th><?php echo $paginator->sort('lang_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($threadcats as $threadcat):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $threadcat['Threadcat']['id']; ?>
		</td>
		<td>
			<?php echo $threadcat['Threadcat']['name']; ?>
		</td>
		<td>
			<?php echo $html->link($threadcat['Game']['name'], array('controller'=> 'games', 'action'=>'view', $threadcat['Game']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($threadcat['Lang']['name'], array('controller'=> 'langs', 'action'=>'view', $threadcat['Lang']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $threadcat['Threadcat']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $threadcat['Threadcat']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $threadcat['Threadcat']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $threadcat['Threadcat']['id'])); ?>
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
		<li><?php echo $html->link(__('New Threadcat', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Langs', true), array('controller'=> 'langs', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Lang', true), array('controller'=> 'langs', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Threads', true), array('controller'=> 'threads', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Thread', true), array('controller'=> 'threads', 'action'=>'add')); ?> </li>
	</ul>
</div>
