<div class="matchparts view">
<h2><?php  __('Matchpart');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $matchpart['Matchpart']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $matchpart['Matchpart']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Game'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($matchpart['Game']['name'], array('controller'=> 'games', 'action'=>'view', $matchpart['Game']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Constant'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $matchpart['Matchpart']['constant']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Matchpart', true), array('action'=>'edit', $matchpart['Matchpart']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Matchpart', true), array('action'=>'delete', $matchpart['Matchpart']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $matchpart['Matchpart']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Matchparts', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Matchpart', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Results', true), array('controller'=> 'results', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Results');?></h3>
	<?php if (!empty($matchpart['Result'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Team1 Score'); ?></th>
		<th><?php __('Team2 Score'); ?></th>
		<th><?php __('Matchpart Id'); ?></th>
		<th><?php __('Match Id'); ?></th>
		<th><?php __('Map Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($matchpart['Result'] as $result):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $result['id'];?></td>
			<td><?php echo $result['team1_score'];?></td>
			<td><?php echo $result['team2_score'];?></td>
			<td><?php echo $result['matchpart_id'];?></td>
			<td><?php echo $result['match_id'];?></td>
			<td><?php echo $result['map_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'results', 'action'=>'view', $result['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'results', 'action'=>'edit', $result['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'results', 'action'=>'delete', $result['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $result['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
