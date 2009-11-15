<div class="infos view">
<h2><?php  __('Info');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $info['Info']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $info['Info']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Desc'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $info['Info']['desc']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Body'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $info['Info']['body']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $info['Info']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $info['Info']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($info['User']['name'], array('controller'=> 'users', 'action'=>'view', $info['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Infocat'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($info['Infocat']['name'], array('controller'=> 'infocats', 'action'=>'view', $info['Infocat']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lang'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($info['Lang']['name'], array('controller'=> 'langs', 'action'=>'view', $info['Lang']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Game'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($info['Game']['name'], array('controller'=> 'games', 'action'=>'view', $info['Game']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Info', true), array('action'=>'edit', $info['Info']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Info', true), array('action'=>'delete', $info['Info']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $info['Info']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Infos', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Info', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Infocats', true), array('controller'=> 'infocats', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Infocat', true), array('controller'=> 'infocats', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Langs', true), array('controller'=> 'langs', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Lang', true), array('controller'=> 'langs', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Infocomments', true), array('controller'=> 'infocomments', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Infocomment', true), array('controller'=> 'infocomments', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Infocomments');?></h3>
	<?php if (!empty($info['Infocomment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Body'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Info Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($info['Infocomment'] as $infocomment):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $infocomment['id'];?></td>
			<td><?php echo $infocomment['body'];?></td>
			<td><?php echo $infocomment['created'];?></td>
			<td><?php echo $infocomment['user_id'];?></td>
			<td><?php echo $infocomment['info_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'infocomments', 'action'=>'view', $infocomment['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'infocomments', 'action'=>'edit', $infocomment['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'infocomments', 'action'=>'delete', $infocomment['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $infocomment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Infocomment', true), array('controller'=> 'infocomments', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
