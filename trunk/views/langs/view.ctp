<div class="langs view">
<h2><?php  __('Lang');?></h2>
<dl>
<?php $i = 0; $class = ' class="altrow"';?>
	<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
	<dd <?php if ($i++ % 2 == 0) echo $class;?>><?php echo $lang['Lang']['id']; ?>
	&nbsp;</dd>
	<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
	<dd <?php if ($i++ % 2 == 0) echo $class;?>><?php echo $lang['Lang']['name']; ?>
	&nbsp;</dd>
	<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Code'); ?></dt>
	<dd <?php if ($i++ % 2 == 0) echo $class;?>><?php echo $lang['Lang']['code']; ?>
	&nbsp;</dd>
</dl>
</div>
<div class="actions">
<ul>
	<li><?php echo $html->link(__('Edit Lang', true), array('action'=>'edit', $lang['Lang']['id'])); ?>
	</li>
	<li><?php echo $html->link(__('Delete Lang', true), array('action'=>'delete', $lang['Lang']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $lang['Lang']['id'])); ?>
	</li>
	<li><?php echo $html->link(__('List Langs', true), array('action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Lang', true), array('action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Gamewords', true), array('controller'=> 'gamewords', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Gameword', true), array('controller'=> 'gamewords', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Infos', true), array('controller'=> 'infos', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Info', true), array('controller'=> 'infos', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Threadcats', true), array('controller'=> 'threadcats', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Threadcat', true), array('controller'=> 'threadcats', 'action'=>'add')); ?>
	</li>
</ul>
</div>
<div class="related">
<h3><?php __('Related Gamewords');?></h3>
<?php if (!empty($lang['Gameword'])):?>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Label'); ?></th>
		<th><?php __('Value'); ?></th>
		<th><?php __('Game Id'); ?></th>
		<th><?php __('Lang Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($lang['Gameword'] as $gameword):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $gameword['id'];?></td>
		<td><?php echo $gameword['label'];?></td>
		<td><?php echo $gameword['value'];?></td>
		<td><?php echo $gameword['game_id'];?></td>
		<td><?php echo $gameword['lang_id'];?></td>
		<td class="actions"><?php echo $html->link(__('View', true), array('controller'=> 'gamewords', 'action'=>'view', $gameword['id'])); ?>
		<?php echo $html->link(__('Edit', true), array('controller'=> 'gamewords', 'action'=>'edit', $gameword['id'])); ?>
		<?php echo $html->link(__('Delete', true), array('controller'=> 'gamewords', 'action'=>'delete', $gameword['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $gameword['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
	<?php endif; ?>

<div class="actions">
<ul>
	<li><?php echo $html->link(__('New Gameword', true), array('controller'=> 'gamewords', 'action'=>'add'));?>
	</li>
</ul>
</div>
</div>
<div class="related">
<h3><?php __('Related Infos');?></h3>
	<?php if (!empty($lang['Info'])):?>
<table cellpadding="0" cellspacing="0">
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
	foreach ($lang['Info'] as $info):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $info['id'];?></td>
		<td><?php echo $info['title'];?></td>
		<td><?php echo $info['desc'];?></td>
		<td><?php echo $info['body'];?></td>
		<td><?php echo $info['created'];?></td>
		<td><?php echo $info['modified'];?></td>
		<td><?php echo $info['user_id'];?></td>
		<td><?php echo $info['infocat_id'];?></td>
		<td><?php echo $info['lang_id'];?></td>
		<td><?php echo $info['game_id'];?></td>
		<td class="actions"><?php echo $html->link(__('View', true), array('controller'=> 'infos', 'action'=>'view', $info['id'])); ?>
		<?php echo $html->link(__('Edit', true), array('controller'=> 'infos', 'action'=>'edit', $info['id'])); ?>
		<?php echo $html->link(__('Delete', true), array('controller'=> 'infos', 'action'=>'delete', $info['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $info['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
	<?php endif; ?>

<div class="actions">
<ul>
	<li><?php echo $html->link(__('New Info', true), array('controller'=> 'infos', 'action'=>'add'));?>
	</li>
</ul>
</div>
</div>
<div class="related">
<h3><?php __('Related Threadcats');?></h3>
	<?php if (!empty($lang['Threadcat'])):?>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Game Id'); ?></th>
		<th><?php __('Lang Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($lang['Threadcat'] as $threadcat):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $threadcat['id'];?></td>
		<td><?php echo $threadcat['name'];?></td>
		<td><?php echo $threadcat['game_id'];?></td>
		<td><?php echo $threadcat['lang_id'];?></td>
		<td class="actions"><?php echo $html->link(__('View', true), array('controller'=> 'threadcats', 'action'=>'view', $threadcat['id'])); ?>
		<?php echo $html->link(__('Edit', true), array('controller'=> 'threadcats', 'action'=>'edit', $threadcat['id'])); ?>
		<?php echo $html->link(__('Delete', true), array('controller'=> 'threadcats', 'action'=>'delete', $threadcat['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $threadcat['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
	<?php endif; ?>

<div class="actions">
<ul>
	<li><?php echo $html->link(__('New Threadcat', true), array('controller'=> 'threadcats', 'action'=>'add'));?>
	</li>
</ul>
</div>
</div>
