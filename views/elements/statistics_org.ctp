<?php
	$stats = $this->requestAction('statistics/orgs/org_id:' . $org_id . '/game_id:' . $game_id);
?>

<?php if (!empty($stats)):?>

<table class="contentpaneopen">
<tr>	
	<th><?php echo __('Admin');?></th>
	<th><?php echo __('Events');?></th>
	<th><?php echo __('Matches');?></th>
	<th><?php echo __('Matches/Event');?></th>

	
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
			<?php echo $statistic['Statistic']['username']; ?>
		</td>
		<td>
			<?php echo $statistic['Statistic']['events']; ?>
		</td>		
		<td>
			<?php echo $statistic['Statistic']['matches']; ?>
		</td>
		<td>
			<?php if ($statistic['Statistic']['matches'] && $statistic['Statistic']['events']) echo round($statistic['Statistic']['matches'] / $statistic['Statistic']['events'], 2);
				else echo "-";				
			?>		</td>
	
		
	</tr>
<?php endforeach; ?>
</table>

<?php else: ?>
	<div class="view">
		<?php __("No statistics"); ?>	
	</div>
<?php endif; ?>