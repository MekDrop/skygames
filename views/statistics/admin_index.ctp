<div class="statistics index">
<h2><?php __('Statistics');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('team_id');?></th>
	<th><?php echo $paginator->sort('matches');?></th>
	<th><?php echo $paginator->sort('maps');?></th>
	<th><?php echo $paginator->sort('won');?></th>
	<th><?php echo $paginator->sort('lost');?></th>
	<th><?php echo $paginator->sort('frags');?></th>
	<th><?php echo $paginator->sort('deaths');?></th>
	<th><?php echo $paginator->sort('events');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($statistics as $statistic):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $statistic['Statistic']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($statistic['Team']['name'], array('controller'=> 'teams', 'action'=>'view', $statistic['Team']['id'])); ?>
		</td>
		<td>
			<?php echo $statistic['Statistic']['matches']; ?>
		</td>
		<td>
			<?php echo $statistic['Statistic']['maps']; ?>
		</td>
		<td>
			<?php echo $statistic['Statistic']['won']; ?>
		</td>
		<td>
			<?php echo $statistic['Statistic']['lost']; ?>
		</td>
		<td>
			<?php echo $statistic['Statistic']['frags']; ?>
		</td>
		<td>
			<?php echo $statistic['Statistic']['deaths']; ?>
		</td>
		<td>
			<?php echo $statistic['Statistic']['events']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $statistic['Statistic']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $statistic['Statistic']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $statistic['Statistic']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $statistic['Statistic']['id'])); ?>
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
		<li><?php echo $html->link(__('New Statistic', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Teams', true), array('controller'=> 'teams', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Team', true), array('controller'=> 'teams', 'action'=>'add')); ?> </li>
	</ul>
</div>
