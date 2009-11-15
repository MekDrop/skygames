<div class="infocats view">
<h2><?php  __('Infocat');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $infocat['Infocat']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $infocat['Infocat']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Game'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($infocat['Game']['name'], array('controller'=> 'games', 'action'=>'view', $infocat['Game']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Infocat', true), array('action'=>'edit', $infocat['Infocat']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Infocat', true), array('action'=>'delete', $infocat['Infocat']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $infocat['Infocat']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Infocats', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Infocat', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Infos', true), array('controller'=> 'infos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Info', true), array('controller'=> 'infos', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Infos');?></h3>
	<?php if (!empty($infocat['Info'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Desc'); ?></th>
		<th><?php __('Body'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Infocat Id'); ?></th>
		<th><?php __('Lang Id'); ?></th>
		<th><?php __('Game Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($infocat['Info'] as $info):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $info['id'];?></td>
			<td><?php echo $info['title'];?></td>
			<td><?php echo strip_tags(substr($info['desc'],0,128));?></td>
			<td><?php echo strip_tags(substr($info['body'],0,128));?></td>
			<td><?php echo $info['created'];?></td>
			<td><?php echo $info['modified'];?></td>
			<td><?php echo $info['user_id'];?></td>
			<td><?php echo $info['infocat_id'];?></td>
			<td><?php echo $info['lang_id'];?></td>
			<td><?php echo $info['game_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'infos', 'action'=>'view', $info['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'infos', 'action'=>'edit', $info['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'infos', 'action'=>'delete', $info['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $info['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Info', true), array('controller'=> 'infos', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
