<div class="infocats index">
<h2><?php __('Infocats');?></h2>
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
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($infocats as $infocat):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $infocat['Infocat']['id']; ?>
		</td>
		<td>
			<?php echo $infocat['Infocat']['name']; ?>
		</td>
		<td>
			<?php echo $html->link($infocat['Game']['name'], array('controller'=> 'games', 'action'=>'view', $infocat['Game']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $infocat['Infocat']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $infocat['Infocat']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $infocat['Infocat']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $infocat['Infocat']['id'])); ?>
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
		<li><?php echo $html->link(__('New Infocat', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Infos', true), array('controller'=> 'infos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Info', true), array('controller'=> 'infos', 'action'=>'add')); ?> </li>
	</ul>
</div>
