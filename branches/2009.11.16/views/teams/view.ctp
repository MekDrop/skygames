<div class="teams view">
	<table>
		<tr>
			<td style="width:75px;vertical-align:top">									
				<?php if ($team['Team']['logo_url']): ?>
					<img src="<?php echo $team['Team']['logo_url']; ?>" />					
				<?php else: ?>
					<img src="/img/uploads/logos/no_logo.jpg" />									
				<?php endif; ?>
			</td>
			<td style="width:15px;vertical-align:top">									
				
			</td>
			<td>
			
			
				<table class="list">	
					<tr>
						<td>
							<?php __('Tag'); ?>
						</td>
						<td>
							<?php echo $team['Team']['tag']; ?>
						</td>			
					</tr>
					<tr>
						<td>
							<?php __('Owner'); ?>
						</td>
						<td>
							<table cellspacing="0" cellpadding="0">
								<tr>
									<td style="vertical-align: middle;">
										<?php echo $html->image('/img/orgs/member.png') ?>
									</td>
									<td style="vertical-align: middle;">
										<?php echo $html->link($team['User']['username'], array('controller'=> 'users', 'action'=>'view', $team['User']['id'])); ?>	
									</td>																
								</tr>
							</table>							
						</td>			
					</tr>
					<?php if ($team['Teamdetail']['website']): ?>
					<tr>
						<td>
							<?php __('Website'); ?>
						</td>
						<td>
							<?php echo $team['Teamdetail']['website']; ?>
						</td>			
					</tr>
					<?php endif; ?>
					<?php if ($team['Teamdetail']['irc']): ?>
					<tr>
						<td>
							<?php __('Irc'); ?>
						</td>
						<td>
							<?php echo $team['Teamdetail']['irc']; ?>
						</td>			
					</tr>
					<?php endif; ?>
				</table>	
			</td>
		</tr>
	</table>
</div>
<br/>
<br/>
<div class="related">		
	<div class="caption"><?php __('Team Players');?></div><br/>
	<?php if ( !empty($team['Teamplayer']) || !empty($team['Member'])):?>	
	<table cellpadding = "1" cellspacing = "1" class="list">
	<?php
		$i = 0;
		foreach ($team['Teamplayer'] as $player):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td>
				<?php echo $player['name']; ?>
			</td>
		</tr>
	<?php endforeach; ?>
	<?php
		$i = 0;
		foreach ($team['Member'] as $player):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		
		<tr<?php echo $class;?>>
			<td>
				<?php echo $html->link($player['name'], array('controller' => 'users','action'=>'view', $player['id'])); ?> 
				<?php if ($player['Membership']['status'] != 'member')  echo '('. __('Invited', true) . ')'; ?>			
			</td>
		</tr>
		
	<?php endforeach; ?>
	</table>
	<?php else: ?>
		<?php __('Team has no players'); ?>	
	<?php endif; ?>
</div>
<br/>
<br/>

<div class="related">
	<div class="caption"><?php __('Team Events');?></div><br/>
	<?php if (!empty($team['Venue'])):?>
	<table cellpadding = "1" cellspacing = "1" class="list">
	<?php
		$i = 0;
		foreach ($team['Venue'] as $event):
			$class = null;
			if ($i++ % 2 != 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td>				
				<table cellspacing="0" cellpadding="0">
					<tr>
						<td style="vertical-align: middle;">
							<?php echo $html->image('/img/orgs/team.png') ?>
						</td>
						<td style="vertical-align: middle;">
							<?php echo $html->link($event['name'], array('controller'=> 'events', 'action'=>'view', $event['id'])); ?>	
						</td>																
					</tr>
				</table>			
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php else: ?>
		<?php __('Team has no events'); ?>	
	<?php endif; ?>	
</div>




