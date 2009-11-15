<?php
	$stats = $this->requestAction('statistics/events/' . $event_id);
?>

<?php if (!empty($stats)):?>

<table class="contentpaneopen">
<tr>	
	<th><?php echo __('Team');?></th>
	<th><?php echo __('Efficiency');?></th>
	<th><?php echo __('matches');?></th>
	<th><?php echo __('maps');?></th>
	<th><?php echo __('won');?></th>
	<th><?php echo __('lost');?></th>
	<th><?php echo __('rounds won');?></th>
	<th><?php echo __('rounds lost');?></th>	
	
	
</tr>
<?php
$i = 0;
foreach ($stats as $statistic):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php //echo $html->link($statistic['Team']['name'], array('controller'=> 'teams', 'action'=>'view', $statistic['Team']['id'])); ?>
			<?php echo $statistic['Statistic']['name']; ?>
		</td>
		<td>
			<?php echo $statistic['Statistic']['eff']; ?>%
		</td>		
		<td>
			<?php echo $statistic['Statistic']['matches_count']; ?>
		</td>
		<td>
			<?php echo $statistic['Statistic']['maps_count']; ?>
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

		
	</tr>
<?php endforeach; ?>
</table>

<?php else: ?>
	<div class="view">
		<?php __("No statistics"); ?>	
	</div>
<?php endif; ?>
