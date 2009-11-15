<?php
	 echo $javascript->link('prototype');
 	 echo $javascript->link('scriptaculous');
?>

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
			<td>	
				<table class="clickable">
					<tr>
					<td>
						<table style="background-color: #e7e7e7;">
						<tr>
							<td style="background-color:#f5f5f5;">
								<?php echo $html->link(__('Betts', true),array('action'=>'betts'),array('class'=>'nonunderline')); ?>
							</td>
						</tr>
						</table>
					</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
</div>

<?php
	$allValues = array (		
		"-5" => __("All", true) . " 5on5",
		"-2" => __("All", true) . " 2on2"
	);

?>

<div class="stats index" >
		<?php echo $form->create('Statistic', array('action' => 'teams', 'id' => 'Statistic'));?>

		<table style="width: 100%;">
			<tr>
				<td>
					<?php echo $form->label('Event.game_id', __('Game', true));?>
					<?php echo $form->select('game_id', $games, (!empty($this->data['Statistic']['game_id']) ? $this->data['Statistic']['game_id'] : 1), array( 'id' => 'Games'), false); ?>
				</td>
			
				<td>
					<?php echo $form->label('Event.org_id', __('Organized by', true)); ?>
					<?php echo $form->select('org_id', $orgs, (!empty($this->data['Statistic']['org_id']) ? $this->data['Statistic']['org_id'] : ''), array('class' => 'ivestis', 'id' => 'Orgs'), __('Allf',true));	?>
				</td>			
				
				<td>
					<?php echo $form->label('Event.event_id', __('Event', true)); ?>
					<?php echo $form->select('event_id', (empty($events) ? $allValues : $allValues + $events ), (!empty($this->data['Statistic']['event_id']) ? $this->data['Statistic']['event_id'] : '-5'), array('class' => 'ivestis', 'id' => 'Events', 'onchange' => 'return true;'), false);	?>
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

<div class="view list">

<?php if (!empty($statistics)): ?>
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
	
	<?php if (empty($this->data['Statistic']['event_id']) || $this->data['Statistic']['event_id'] < 0): ?>	
		<th><?php echo __('events');?></th>
	<?php endif; ?>	
	
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
			
			<?php if (empty($this->data['Statistic']['event_id']) || $this->data['Statistic']['event_id'] < 0): ?>
				<td>
					<?php echo $statistic['Statistic']['events_count']; ?>
				</td>
			<?php endif; ?>
	
			
		</tr>
	<?php endforeach; ?>

</table>
<?php endif; ?>
</div>
<?php

	//echo $ajax->observeForm('Statistic', array('url' => 'select_event', 'update' => 'Events' ) );
	echo $ajax->observeField('Games', array('url' => 'select_event/team', 'update' => 'Events', 'with' => "Form.serialize('Statistic')" ));
	echo $ajax->observeField('Orgs', array('url' => 'select_event/team', 'update' => 'Events', 'with' => "Form.serialize('Statistic')" ));

?>
