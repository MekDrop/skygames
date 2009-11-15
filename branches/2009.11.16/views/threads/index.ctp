<div class="threads index">
<h2><?php __('Threads');?></h2>

<table cellpadding="0" cellspacing="0">

<?php
$i = 0;
foreach ($threads as $thread):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $thread['Thread']['id']; ?>
		</td>
		<td>
			<?php echo $thread['Thread']['title']; ?>
		</td>
		<td>
			<?php echo $thread['Thread']['body']; ?>
		</td>
		<td>
			<?php echo $thread['Thread']['created']; ?>
		</td>
		<td>
			<?php echo $thread['Thread']['modified']; ?>
		</td>
		<td>
			<?php echo $html->link($thread['User']['name'], array('controller'=> 'users', 'action'=>'view', $thread['User']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($thread['Threadcat']['name'], array('controller'=> 'threadcats', 'action'=>'view', $thread['Threadcat']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $thread['Thread']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $thread['Thread']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $thread['Thread']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $thread['Thread']['id'])); ?>
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
		<li><?php echo $html->link(__('New Thread', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Threadcats', true), array('controller'=> 'threadcats', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Threadcat', true), array('controller'=> 'threadcats', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Posts', true), array('controller'=> 'posts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Post', true), array('controller'=> 'posts', 'action'=>'add')); ?> </li>
	</ul>
</div>
