<div class="view">
	<table border="0">
		<tr>
			<td style="width:75px;vertical-align:top">									
				<?php if ($user['User']['avatar_url']): ?>
					<img src="<?php echo $user['User']['avatar_url']; ?>" alt="<?php echo $user['User']['name']; ?>" />					
				<?php else: ?>
					<img src="/img/uploads/avatars/no_avatar.gif" alt="" />									
				<?php endif; ?>
			</td>
			<td style="width:15px;vertical-align:top">									
				
			</td>
			<td style="width:auto;vertical-align:top;">
				<table>
					<tr>
						<td>
							<?php __('Name'); ?>
						</td>
						<td>
							<?php echo $user['User']['name']; ?>
						</td>			
					</tr>
					<?php if (!empty($user['Userdetail']['pers_age'])): ?>
						<tr>
							<td>
								<?php __('Age'); ?>
							</td>
							<td>
								<?php echo $user['Userdetail']['pers_age']; ?>
							</td>		
						</tr>
					<?php endif; ?>
					<?php if (!empty($user['Userdetail']['pers_city'])): ?>
					    <tr>
							<td>
								<?php __('City'); ?>
							</td>
							<td>
								<?php echo $user['Userdetail']['pers_city']; ?>
							</td>		
						</tr>							
					<?php endif; ?>
					<tr>
						<td>
							<?php __('Email'); ?>
						</td>
						<td>
							<?php echo $user['User']['email']; ?>
						</td>			
					</tr>
					<tr>
						<td>
							<?php __('Last Visit'); ?>
						</td>
						<td>
							<?php echo $user['User']['last_visit']; ?>
						</td>			
					</tr>		
					<tr>
						<td>
							<?php __('Created'); ?>
						</td>
						<td>
							<?php echo $user['User']['created']; ?>
						</td>		
					</tr>
							
				</table>							
			</td>		
		</tr>		
	</table>
</div>
<br/>
<br/>
<?php if (!empty($uniqueids)): ?>
<div class="related">
	<div class="caption"><?php __('Gameids'); ?></div>
	<br/>
	<table cellpadding = "1" cellspacing = "1" class="list">
	<?php
		 $i = 0;	
		 foreach ($uniqueids as $uniqueid): ?>	
		<?php $class = null;
			if ($i++ % 2 != 0) {
				$class = ' class="altrow"';
			}
			?>
		<tr<?php echo $class;?>>
			<td>
				<?php echo $html->image($uniqueid['Game']['icon']); ?>
			</td>				
			<td>
				<?php echo $uniqueid['Game']['name']; ?>
			</td>	
			<td>
				<?php echo $uniqueid['Uniqueid']['value']; ?>	
			</td>				
		</tr>
		<?php endforeach; ?>							
	</table>
</div>
<br/>
<br/>

<?php endif; ?>

<div class="view list">
<table class="contentpaneopen" cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td valign="top" style="width:45%;">
	<div class="caption"><?php __('Owned Teams');?></div>
	<br/>
	<?php if (!empty($user['Team'])):?>
	<table cellpadding = "1" cellspacing = "1" class="list">
	<?php
		$i = 0;
		foreach ($user['Team'] as $team):		
		?>
		<tr>
			<td>
				<?php echo $html->link($team['name'], array('controller'=> 'teams', 'action'=>'view', $team['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php else: ?>
		<div class="related">
			<?php __("No teams"); ?>
		</div>
<?php endif; ?>
	</td>
	<td style="width:10%;">&nbsp;</td>
	<td valign="top" style="width:45%;">
		<?php if (!empty($user['Clan'])):?>
		<div class="caption"><?php __('Member of teams');?></div>
		<br/>
		<table cellpadding = "1" cellspacing = "1" class="list">
		<?php
			foreach ($user['Clan'] as $team):
			?>
			<tr>
				<td>
					<?php echo $html->link($team['name'], array('controller'=> 'teams', 'action'=>'view', $team['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
		<?php endif; ?>
		
		
	</td>
	</tr>	

</table>
</div>

<br/>
<br/>

<div class="view list">
	<table class="contentpaneopen" cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td valign="top" style="width:45%;">
			<?php if($user['Userdetail']['fav_game'] || $user['Userdetail']['fav_sport'] || $user['Userdetail']['fav_music'] ||
			$user['Userdetail']['fav_movie'] || $user['Userdetail']['fav_car'] || $user['Userdetail']['fav_game'] || $user['Userdetail']['fav_drink']): ?>
				<div class="caption"><?php __('Interests');?></div>
				<br/>
				<table cellpadding = "1" cellspacing = "1" class="list">
					<?php if (!empty($user['Userdetail']['fav_game'])): ?>
					<tr>
						<th>
							<?php __('Fav Game'); ?>
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['Userdetail']['fav_game']; ?>
						</td>
					</tr>
					<?php endif; ?>
					<?php if (!empty($user['Userdetail']['fav_sport'])): ?>
					<tr>
						<th>
							<?php __('Fav Sport'); ?>
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['Userdetail']['fav_sport']; ?>
						</td>
					</tr>
					<?php endif; ?>
					<?php if (!empty($user['Userdetail']['fav_music'])): ?>
					<tr>
						<th>
							<?php __('Fav Music'); ?>
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['Userdetail']['fav_music']; ?>
						</td>
					</tr>
					<?php endif; ?>
					<?php if (!empty($user['Userdetail']['fav_movie'])): ?>
					<tr>
						<th>
							<?php __('Fav Movie'); ?>
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['Userdetail']['fav_movie']; ?>
						</td>
					</tr>
					<?php endif; ?>
									<?php if (!empty($user['Userdetail']['fav_movie'])): ?>
					<tr>
						<th>
							<?php __('Fav Movie'); ?>
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['Userdetail']['fav_movie']; ?>
						</td>
					</tr>
					<?php endif; ?>				
					<?php if (!empty($user['Userdetail']['fav_car'])): ?>
					<tr>
						<th>
							<?php __('Fav Car'); ?>
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['Userdetail']['fav_car']; ?>
						</td>
					</tr>
					<?php endif; ?>
					<?php if (!empty($user['Userdetail']['fav_drink'])): ?>
					<tr>
						<th>
							<?php __('Fav Drink'); ?>
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['Userdetail']['fav_drink']; ?>
						</td>
					</tr>
					<?php endif; ?>
				</table>
				<br/>
				<br/>
			<?php endif; ?>
			</td>
			
			<td style="width:10%;">&nbsp;</td>
			
			<td valign="top" style="width:45%;">
			<?php if($user['Userdetail']['hardw_mouse'] || $user['Userdetail']['hardw_mousepad'] || $user['Userdetail']['hardw_headset'] ||
						$user['Userdetail']['hardw_graphcard'] || $user['Userdetail']['hardw_memory'] || $user['Userdetail']['hardw_cpu'] ||
						$user['Userdetail']['hardw_monitor']): ?>
				<div class="caption"><?php __('Hardware');?></div>
				<br/>
				<table cellpadding = "1" cellspacing = "1" class="list">		
					<?php if (!empty($user['Userdetail']['hardw_mouse'])): ?>
					<tr>
						<th>
							<?php __('Hardw Mouse'); ?>
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['Userdetail']['hardw_mouse']; ?>
						</td>
					</tr>
					<?php endif; ?>
					<?php if (!empty($user['Userdetail']['hardw_mousepad'])): ?>
					<tr>
						<th>
							<?php __('Hardw Mousepad'); ?>
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['Userdetail']['hardw_mousepad']; ?>
						</td>
					</tr>
					<?php endif; ?>
					<?php if (!empty($user['Userdetail']['hardw_headset'])): ?>
					<tr>
						<th>
							<?php __('Hardw Headset'); ?>
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['Userdetail']['hardw_headset']; ?>
						</td>
					</tr>
					<?php endif; ?>
					<?php if (!empty($user['Userdetail']['hardw_graphcard'])): ?>
					<tr>
						<th>
							<?php __('Hardw Graphcard'); ?>
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['Userdetail']['hardw_graphcard']; ?>
						</td>
					</tr>
					<?php endif; ?>
					<?php if (!empty($user['Userdetail']['hardw_memory'])): ?>
					<tr>
						<th>
							<?php __('Hardw Memory'); ?>
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['Userdetail']['hardw_memory']; ?>
						</td>
					</tr>
					<?php endif; ?>		
					<?php if (!empty($user['Userdetail']['hardw_cpu'])): ?>
					<tr>
						<th>
							<?php __('Hardw Cpu'); ?>
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['Userdetail']['hardw_cpu']; ?>
						</td>
					</tr>
					<?php endif; ?>			
					<?php if (!empty($user['Userdetail']['hardw_monitor'])): ?>
					<tr>
						<th>
							<?php __('Hardw Monitor'); ?>
						</th>
					</tr>
					<tr>
						<td>
							&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $user['Userdetail']['hardw_monitor']; ?>
						</td>
					</tr>
					<?php endif; ?>	
				</table>
				<br/>
				<br/>
			<?php endif; ?>								
			</td>
		</tr>	
		<?php if (!empty($user['Userdetail']['pers_more'])): ?>
			<tr>
				<th colspan="2">
					<?php __('Achievements, other...'); ?>
				</th>
			</tr>
			<tr>
			
				<td coslpan="2">
					<?php echo nl2br($user['Userdetail']['pers_more']); ?>
				</td>
			</tr>	
		<?php endif; ?>	
		
	</table>
</div>

<br/>
<br/>

<?php echo $this->renderElement('guestbook', array('cache'=>false, 'commentsModel' => 'Usercomment', 'commentParentName' => 'user_id', 'commentParentValue' => $user['User']['id']));?>


