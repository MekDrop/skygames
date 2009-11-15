<div class="games view">
<h2><?php  __('Game');?></h2>
<dl>
<?php $i = 0; $class = ' class="altrow"';?>
	<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
	<dd <?php if ($i++ % 2 == 0) echo $class;?>><?php echo $game['Game']['id']; ?>
	&nbsp;</dd>
	<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
	<dd <?php if ($i++ % 2 == 0) echo $class;?>><?php echo $game['Game']['name']; ?>
	&nbsp;</dd>
	<dt <?php if ($i % 2 == 0) echo $class;?>><?php __('Icon'); ?></dt>
	<dd <?php if ($i++ % 2 == 0) echo $class;?>><?php echo $game['Game']['icon']; ?>
	&nbsp;</dd>
</dl>
</div>
<div class="actions">
<ul>
	<li><?php echo $html->link(__('Edit Game', true), array('action'=>'edit', $game['Game']['id'])); ?>
	</li>
	<li><?php echo $html->link(__('Delete Game', true), array('action'=>'delete', $game['Game']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $game['Game']['id'])); ?>
	</li>
	<li><?php echo $html->link(__('List Games', true), array('action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Game', true), array('action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Events', true), array('controller'=> 'events', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Event', true), array('controller'=> 'events', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Matchparts', true), array('controller'=> 'matchparts', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Matchpart', true), array('controller'=> 'matchparts', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Gamewords', true), array('controller'=> 'gamewords', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Gameword', true), array('controller'=> 'gamewords', 'action'=>'add')); ?>
	</li>
</ul>
</div>
<div class="related">
<h3><?php __('Related Events');?></h3>
<?php if (!empty($game['Event'])):?>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Game Id'); ?></th>
		<th><?php __('Eventtype Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($game['Event'] as $event):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $event['id'];?></td>
		<td><?php echo $event['name'];?></td>
		<td><?php echo $event['game_id'];?></td>
		<td><?php echo $event['eventtype_id'];?></td>
		<td class="actions"><?php echo $html->link(__('View', true), array('controller'=> 'events', 'action'=>'view', $event['id'])); ?>
		<?php echo $html->link(__('Edit', true), array('controller'=> 'events', 'action'=>'edit', $event['id'])); ?>
		<?php echo $html->link(__('Delete', true), array('controller'=> 'events', 'action'=>'delete', $event['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $event['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
	<?php endif; ?>

<div class="actions">
<ul>
	<li><?php echo $html->link(__('New Event', true), array('controller'=> 'events', 'action'=>'add'));?>
	</li>
</ul>
</div>
</div>
<div class="related">
<h3><?php __('Related Matchparts');?></h3>
	<?php if (!empty($game['Matchpart'])):?>
<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Game Id'); ?></th>
		<th><?php __('Constant'); ?></th>
		<th><?php __('Final'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($game['Matchpart'] as $matchpart):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $matchpart['id'];?></td>
		<td><?php echo $matchpart['title'];?></td>
		<td><?php echo $matchpart['game_id'];?></td>
		<td><?php echo $matchpart['constant'];?></td>
		<td><?php echo $matchpart['final'];?></td>
		<td class="actions"><?php echo $html->link(__('View', true), array('controller'=> 'matchparts', 'action'=>'view', $matchpart['id'])); ?>
		<?php echo $html->link(__('Edit', true), array('controller'=> 'matchparts', 'action'=>'edit', $matchpart['id'])); ?>
		<?php echo $html->link(__('Delete', true), array('controller'=> 'matchparts', 'action'=>'delete', $matchpart['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $matchpart['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
	<?php endif; ?>

<div class="actions">
<ul>
	<li><?php echo $html->link(__('New Matchpart', true), array('controller'=> 'matchparts', 'action'=>'add'));?>
	</li>
</ul>
</div>
</div>
<div class="related">
<h3><?php __('Related Gamewords');?></h3>
	<?php if (!empty($game['Gameword'])):?>
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
	foreach ($game['Gameword'] as $gameword):
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
