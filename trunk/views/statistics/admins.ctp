<div class="index">
	<table style="text-align:right;" cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td style="width:99%">
			
			</td>
			<td style="text-align:right">
				<table class="clickable">
					<tr>
					<td>
						<table style="background-color: #e7e7e7;">
						<tr>
							<td style="background-color:#f5f5f5;">
								<?php echo $html->link(__('Teams', true),array('action'=>'teams'),array('class'=>'nonunderline')); ?>
							</td>
						</tr>
						</table>
					</td>
					</tr>
				</table>
			</td>
			<td>
				<table class="clickable">
					<tr>
					<td>
						<table style="background-color: #e7e7e7;">
						<tr>
							<td style="background-color:#f5f5f5;">
								<?php echo $html->link(__('Players', true),array('action'=>'players'),array('class'=>'nonunderline')); ?>
							</td>
						</tr>
						</table>
					</td>
					</tr>
				</table>
			</td>
			<td>	
				<table class="clickable">
					<tr>
					<td>
						<table style="background-color: #e7e7e7;">
						<tr>
							<td style="background-color:#f5f5f5;">
								<?php echo $html->link(__('Admins', true),array('action'=>'admins'),array('class'=>'nonunderline')); ?>
							</td>
						</tr>
						</table>
					</td>
					</tr>
				</table>
			</td>
	</table>
	
</div>


<div class="stats index" >
		<?php echo $form->create('Statistic', array('action' => 'admins', 'id' => 'Statistic'));?>

		<table>
			<tr>
				<td>
					<?php echo $form->label('Event.game_id', __('Game', true));?>
					<?php echo $form->select('game_id', $games, (!empty($this->data['Statistic']['game_id']) ? $this->data['Statistic']['game_id'] : ''), array( 'id' => 'Games'), __('All',true)); ?>
				</td>
			
				<td>
					<?php echo $form->label('Event.org_id', __('Organization', true)); ?>
					<?php echo $form->select('org_id', $orgs, (!empty($this->data['Statistic']['org_id']) ? $this->data['Statistic']['org_id'] : ''), array('class' => 'ivestis', 'id' => 'Orgs'), __('Allf',true));	?>
				</td>			

				<td style="width:20px">
					&nbsp;
				</td>
				
				<td style="vertical-align:bottom">
					<?php echo $form->submit(strtoupper(__('Filter', true)));?>
				</td>
			</tr>	
		</table>

		<?php echo $form->end();?>
</div>
<br/>

<?php if (!empty($stats)):?>

<div class="stats index" >
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
</div>
<?php else: ?>
	<div class="view">
		<?php __("No statistics"); ?>	
	</div>
<?php endif; ?>