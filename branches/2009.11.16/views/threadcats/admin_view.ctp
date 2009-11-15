<div class="threadcats view">
<h2><?php  __('Threadcat');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $threadcat['Threadcat']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $threadcat['Threadcat']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Game'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($threadcat['Game']['name'], array('controller'=> 'games', 'action'=>'view', $threadcat['Game']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lang'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($threadcat['Lang']['name'], array('controller'=> 'langs', 'action'=>'view', $threadcat['Lang']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Threadcat', true), array('action'=>'edit', $threadcat['Threadcat']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Threadcat', true), array('action'=>'delete', $threadcat['Threadcat']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $threadcat['Threadcat']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Threadcats', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Threadcat', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Langs', true), array('controller'=> 'langs', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Lang', true), array('controller'=> 'langs', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Threads', true), array('controller'=> 'threads', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Thread', true), array('controller'=> 'threads', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Threads');?></h3>
	<?php if (!empty($threadcat['Thread'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Body'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Threadcat Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($threadcat['Thread'] as $thread):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $thread['id'];?></td>
			<td><?php echo $thread['title'];?></td>
			<td><?php echo $thread['body'];?></td>
			<td><?php echo $thread['created'];?></td>
			<td><?php echo $thread['modified'];?></td>
			<td><?php echo $thread['user_id'];?></td>
			<td><?php echo $thread['threadcat_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'threads', 'action'=>'view', $thread['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'threads', 'action'=>'edit', $thread['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'threads', 'action'=>'delete', $thread['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $thread['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Thread', true), array('controller'=> 'threads', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
