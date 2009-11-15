<div class="view list">
<table class="contentpaneopen" cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td valign="top">
	<div class="users form">
		<div class="caption">
		<?php __('User properties');?>
		</div>
		<br/>
		<?php echo $form->create('User', array('action' => 'edit', 'type' => 'file'));?>
		<?php		
			echo $form->input('new_passwd', array("type" => "password", "label"=>__("New password",true)));
			echo $form->input('email');
			echo $form->input('skype');
			echo $form->input('id');
		?>
		<br/>		
		<?php echo $form->end(strtoupper(__('Submit', true)));?>

	</div>
	</td>
	<td style="width:10%;">&nbsp;</td>
	<td>
		<div class="caption">
		<?php __('Avatar');?>
		</div>
		<br/>
		<?php if (!empty($user['User']['avatar_url'])): ?>
			<img src="<?php echo $user['User']['avatar_url']; ?>" alt="" />					
		<?php else: ?>
			<img src="/img/uploads/avatars/no_avatar.gif" alt="" />									
		<?php endif; ?>
		
		<?php echo $form->create('User', array('type' => 'file', 'action' => 'upload'));?>		
		<br/>
		<label><?php __("New avatar");?></label>
		<?php
			echo $form->file('avatar_file');	
			echo $form->input('id');		
		?>
		<br/>
		<br/>
		<?php echo $form->end(strtoupper(__('Upload', true)));?>
		
		
	</td>
	</tr>
	<tr>
	<td colspan="3">
	<br/>
	<div class="caption">
		<?php __('Gameids');?>
	</div>
	<br/>
		<?php if (!empty($uniqueids)): ?>
					
			<table cellpadding = "2" cellspacing = "2" class="list">
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
					
						<?php echo $uniqueid['Game']['name']; ?>
					</td>	
					<td>
						<?php echo $uniqueid['Uniqueid']['value']; ?>	
					</td>	
					<td class="actions">						
						<?php echo $html->link(__('Delete', true), array('controller' => 'uniqueids','action'=>'delete', $uniqueid['Uniqueid']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $uniqueid['Uniqueid']['value'])); ?>						
					</td>			
				</tr>
				<?php endforeach; ?>							
			</table>
		<br/>
		<?php endif; ?>
		<div class="uniqueids form">
		
			<?php echo $form->create('Uniqueid');?>
						
					<?php echo $form->input('game_id');?>
									
					<?php echo $form->input('value', array('label' => __('ID', true) . '*'));?>
					<br/>
					*<?php __('Must be unique and only one per game');?>								
							
					<?php echo $form->input('user_id', array('label' => false, 'type'=>'hidden', 'value'=>$this->data['User']['id']));
				?>
			<br/>
			
			<?php echo $form->end(strtoupper(__('Add', true)));?>
		
		</div>
	
	</td>		
	</tr>

	<tr>
		<td colspan="3">
			<?php echo $form->create('Userdetail');?>
			<table class="contentpaneopen" cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>			
					<td colspan="3">
						<br/>
						<br/>
						<div class="caption">
							<?php __('Details');?>
						</div>
						<br/>
					</td>
				</tr>
							
				<tr>
					<td style="vertical-align:top;width:45%">
						
						<?php
							echo $form->input('id');
							
							echo $form->label('personal');
							
							echo "<br/>";
							
							echo $form->input('pers_city');
							echo $form->input('pers_age');
							
						
							echo "<br/>";					
							
							echo $form->label('other');
							
							echo "<br/>";				
							
							echo $form->input('fav_drink');
							echo $form->input('fav_movie');
							echo $form->input('fav_game');
							echo $form->input('fav_music');
							echo $form->input('fav_sport');
							echo $form->input('fav_car');
							
							//echo $form->textarea('pers_more');
							echo "<br/>";
							echo "<br/>";								
							echo $form->input('pers_more', array('label'=>__('More about you (achievements, ex-teams)',true), 'cols' => '40'));
							
						?>
						<br/>
						
				
					</td>
					
					<td width="10%">
						
					</td>
					
					
					<td style="vertical-align:top;width:45%">
						
						<?php
							
							echo $form->label('hardware');
							
							echo "<br/>";				
							
							echo $form->input('hardw_mouse');
							echo $form->input('hardw_mousepad');
							echo $form->input('hardw_headset');
							echo $form->input('hardw_graphcard');
							echo $form->input('hardw_memory');
							echo $form->input('hardw_cpu');
							echo $form->input('hardw_monitor');
														
						?>
										
					</td>
				</tr>
			</table>
			<?php echo $form->end(strtoupper(__('Submit', true)));?>
		</td>
	</tr>
	
</table>
</div>