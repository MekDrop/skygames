<div class="servers index">
<h2><?php __('Servers');?></h2>
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
	<th><?php echo $paginator->sort('last_response');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('ip');?></th>
	<th><?php echo $paginator->sort('port');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($servers as $server):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $server['Server']['id']; ?>
		</td>
		<td>
			<?php echo $server['Server']['name']; ?>
		</td>
		<td>
			<?php echo $html->link($server['Game']['name'], array('controller'=> 'games', 'action'=>'view', $server['Game']['id'])); ?>
		</td>
		<td>
			<?php echo $server['Server']['last_response']; ?>
		</td>
		<td>
			<?php echo $server['Server']['created']; ?>
		</td>
		<td>
			<?php echo $server['Server']['ip']; ?>
		</td>
		<td>
			<?php echo $server['Server']['port']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $server['Server']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $server['Server']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $server['Server']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $server['Server']['id'])); ?>
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
		<li><?php echo $html->link(__('New Server', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?> </li>
	</ul>
</div>
