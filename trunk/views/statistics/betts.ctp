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



<div class="stats index" >
		<?php echo $form->create('Statistic', array('action' => 'betts', 'id' => 'Statistic'));?>

		<table>
			<tr>
				<td>
					<?php echo $form->label('Event.game_id', __('Game', true));?>
					<?php echo $form->select('game_id', $games, (!empty($this->data['Statistic']['game_id']) ? $this->data['Statistic']['game_id'] : ''), array( 'id' => 'Games'), __('All',true)); ?>
				</td>
						
				<td>
					<?php echo $form->label('Event.event_id', __('Event', true)); ?>
					<?php echo $form->select('event_id',  $events , (!empty($this->data['Statistic']['event_id']) ? $this->data['Statistic']['event_id'] : ''), array('class' => 'ivestis', 'id' => 'Events', 'onchange' => 'return true;'),  __('All',true));	?>
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
	<th><?php echo __('User');?></th>
	<th><?php echo __('average win');?></th>
	<th><?php echo __('betts');?></th>	
	<th><?php echo __('won');?></th>
	<th><?php echo __('lost');?></th>
	<th><?php echo __('won');?> $</th>
	<th><?php echo __('lost');?> $</th>	
	<th><?php echo __('matches');?></th>
	
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
				<?php echo $statistic['ordered']['name']; ?>
			</td>
			<td>
				<?php echo $statistic['ordered']['eff']; ?>
			</td>		
			<td>
				<?php echo $statistic['ordered']['betts']; ?>
			</td>
			<td>
				<?php echo $statistic['ordered']['win']; ?>
			</td>
			<td>
				<?php echo $statistic['ordered']['lost']; ?>
			</td>
			<td>
				<?php echo $statistic['ordered']['winpoints']; ?>
			</td>
			<td>
				<?php if ($statistic['ordered']['lostpoints'] > 0) echo $statistic['ordered']['lostpoints']; else echo 0; ?>
				<?php //echo $statistic['ordered']['lostpoints']; ?>
			</td>
			<td>
				<?php echo $statistic['ordered']['matches']; ?>
			</td>
			<?php if (empty($this->data['Statistic']['event_id']) || $this->data['Statistic']['event_id'] < 0): ?>
				<td>
					<?php echo $statistic['ordered']['events']; ?>
				</td>
			<?php endif; ?>
	
			
		</tr>
	<?php endforeach; ?>

</table>
<?php endif; ?>
</div>
<?php

	//echo $ajax->observeForm('Statistic', array('url' => 'select_event', 'update' => 'Events' ) );
	echo $ajax->observeField('Games', array('url' => 'select_event', 'update' => 'Events', 'with' => "Form.serialize('Statistic')" ));	

?>
