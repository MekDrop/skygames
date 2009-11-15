<div class="langs index">
<h2><?php __('Langs');?></h2>
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
	<th><?php echo $paginator->sort('code');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($langs as $lang):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $lang['Lang']['id']; ?>
		</td>
		<td>
			<?php echo $lang['Lang']['name']; ?>
		</td>
		<td>
			<?php echo $lang['Lang']['code']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $lang['Lang']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $lang['Lang']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $lang['Lang']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $lang['Lang']['id'])); ?>
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
		<li><?php echo $html->link(__('New Lang', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Gamewords', true), array('controller'=> 'gamewords', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Gameword', true), array('controller'=> 'gamewords', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Infos', true), array('controller'=> 'infos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Info', true), array('controller'=> 'infos', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Threadcats', true), array('controller'=> 'threadcats', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Threadcat', true), array('controller'=> 'threadcats', 'action'=>'add')); ?> </li>
	</ul>
</div>
