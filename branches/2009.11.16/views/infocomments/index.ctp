<div class="infocomments index">
<h2><?php __('Infocomments');?></h2>
<p><?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $paginator->sort('id');?></th>
		<th><?php echo $paginator->sort('body');?></th>
		<th><?php echo $paginator->sort('created');?></th>
		<th><?php echo $paginator->sort('user_id');?></th>
		<th><?php echo $paginator->sort('info_id');?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($infocomments as $infocomment):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $infocomment['Infocomment']['id']; ?></td>
		<td><?php echo $infocomment['Infocomment']['body']; ?></td>
		<td><?php echo $infocomment['Infocomment']['created']; ?></td>
		<td><?php echo $html->link($infocomment['User']['name'], array('controller'=> 'users', 'action'=>'view', $infocomment['User']['id'])); ?>
		</td>
		<td><?php echo $html->link($infocomment['Info']['title'], array('controller'=> 'infos', 'action'=>'view', $infocomment['Info']['id'])); ?>
		</td>
		<td class="actions"><?php echo $html->link(__('View', true), array('action'=>'view', $infocomment['Infocomment']['id'])); ?>
		<?php echo $html->link(__('Edit', true), array('action'=>'edit', $infocomment['Infocomment']['id'])); ?>
		<?php echo $html->link(__('Delete', true), array('action'=>'delete', $infocomment['Infocomment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $infocomment['Infocomment']['id'])); ?>
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
	<li><?php echo $html->link(__('New Infocomment', true), array('action'=>'add')); ?></li>
	<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Infos', true), array('controller'=> 'infos', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Info', true), array('controller'=> 'infos', 'action'=>'add')); ?>
	</li>
</ul>
</div>
