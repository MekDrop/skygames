<?php
 echo $javascript->link('prototype');
 echo $javascript->link('effects');
 echo $javascript->link('scriptaculous');  
 
 echo $javascript->link('controls');
?>

<script>
	function toggleMore()
	{
		$('divMore').toggle();
		$('divMoreButton').toggle();
	}
</script>

<div class="view list">


<table class="list" cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td valign="top" width="40%">
	<div class="teams form">
		<div class="caption">
			<?php __('Team properties');?>
		</div>
		<br/>
		<?php echo $form->create('Team', array('action' => 'edit'));?> 		
		<?php
			echo $form->input('name', array('label'=>__('Title', true)));
			echo $form->input('moto');
			echo $form->input('tag');
			
			echo $form->input('user_id',array('type'=>'hidden'));		
			echo $form->input('game_id',array('type'=>'hidden'));
			echo $form->input('type',array('type'=>'hidden'));
			echo $form->input('id');
		?>
		<br/>
		<div id="divMoreButton"><i><a href="javascript:toggleMore();"><?php __("more"); ?></a>...</i></div>		
		<div id="divMore" style="display:none">	
			<i><a href="javascript:toggleMore();"><?php __("less"); ?></a>...</i>
			<br/>
			<br/>			
			<?php
				echo $form->input('website');
				echo $form->input('irc', array('label' => 'IRC'));
			?>
		</div>
		<br/>
		<?php echo $form->end(strtoupper(__('Submit', true)));?>
		
	
	</div>
	<br/>
	<br/>
</td>

 <td style="width:5%;">&nbsp;</td> 
 <td rowspan="3" style="vertical-align:top;"  width="55%">
 
		<div class="caption">
		<?php __('Logo');?>
		</div>
		<br/>
		<?php if ($team['Team']['logo_url']): ?>
			<img src="<?php echo $team['Team']['logo_url']; ?>" />					
		<?php else: ?>
			<img src="/img/uploads/logos/no_logo.jpg" />									
		<?php endif; ?>
		
		<?php echo $form->create('Team', array('type' => 'file', 'action' => 'upload'));?>		
		<br/>
		<label><?php __("New logo");?></label>
		<?php
			echo $form->file('logo_file');	
			echo $form->input('id');		
		?>
		<br/>
		<br/>
		<?php echo $form->end(strtoupper(__('Upload', true)));?>
		
		
	</td>
</tr>
<tr>
<td>

</td>
</tr>
<tr>
<td valign="top" colspan="3">	
	<?php if ($this->data['Team']['type'] == 'mix'):?>
	<div class="teamplayers form" >

	<div class="caption">
		<?php __('Team players');?>
	</div>
	<br/>
	
	<?php if (count($this->data['Teamplayer']) > 0):?>
	
		<?php if(count($this->data['Teamplayer']) < 2):?>
		<div style="text-align:left;vertical-align:middle">
			<?php echo $html->image('/img/exclamation2.jpg');?>&nbsp;<?php __("Team has only 1 player."); ?>
			<br/>
			<br/>
			<br/>
		</div>
		<?php endif;?>
	
	<table cellpadding="1" cellspacing="1">
		<tr>			
			<th><?php __('Name');?></th>	
			<th class="actions" colspan="2"><?php __('Actions');?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($this->data['Teamplayer'] as $teamplayer):
			$class = null;
			if ($i++ % 2 != 0) {
				$class = ' class="altrow"';
			}
		?>
			<tr<?php echo $class;?>>
				<td>
				
					<?php echo $teamplayer['name']; ?><?php echo (  $teamplayer['uniqueid'] ? "(" . $teamplayer['uniqueid'] . ")" :  "" ) ?>
				</td>
				<td class="actions">	
					<table cellspacing="0" cellpadding="0">
						<tr>
							<td style="vertical-align: middle;">
								<?php echo $html->image('/img/orgs/edit.png') ?>
							</td>
							<td style="vertical-align: middle;">
								<?php echo $html->link(__('Edit', true), array('controller' => 'teamplayers','action'=>'edit', $teamplayer['id'])); ?>	
							</td>																
						</tr>
					</table>					
				</td>
				<td class="actions">	
					<table cellspacing="0" cellpadding="0">
						<tr>
							<td style="vertical-align: middle;">
								<?php echo $html->image('/img/orgs/del.png') ?>
							</td>
							<td style="vertical-align: middle;">
								<?php echo $html->link(__('Delete', true), array('controller' => 'teamplayers','action'=>'delete', $teamplayer['id'], $this->data['Team']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $teamplayer['name'])); ?>	
							</td>																
						</tr>
					</table>										
				</td>
		</tr>
	<?php endforeach; ?>
	</table>		
	<br/>
	<?php elseif(count($this->data['Teamplayer']) < 1):?>
		<?php echo $html->image('/img/exclamation2.jpg');?>&nbsp;<?php __("Team has no players yet."); ?>
	<?php endif;?>
	</div>
	<br/>	
	
	<div class="teamplayers form">
		
			<?php echo $form->create('Teamplayer');?>
						
					<?php echo $form->input('name');?>
				
					<?php echo $form->input('uniqueid');?>
							
					<?php echo $form->input('team_id', array('type'=>'hidden', 'value'=>$this->data['Team']['id']));
				?>
			<br/>
			<?php echo $form->end(strtoupper(__('Add', true)));?>
		
	</div>
	<?php endif;?>
	
	<?php if ($this->data['Team']['type'] == 'clan'):?>
	<div class="members form">	

	<div class="caption">
		<?php __('Team players');?>
	</div>
	<br/>			
	<?php if (count($members) > 0):?>
	<table cellpadding="1" cellspacing="1">
		<tr>			
			<th><?php __('Name');?></th>
			<th><?php __('UniqueId');?></th>			
			<th class="actions" colspan="2"><?php __('Actions');?></th>
		</tr>
		<?php
		$i = 0;
		foreach ($members as $player):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
			<tr<?php echo $class;?>>
				<td>
					<?php echo $player['User']['name'];?> <?php if ($player['Membership']['status'] == 'invited') { echo '('.__('Not accepted yet',true) . ')';}?>
				</td>
				<td>
					<?php if (!empty($player['User']['Uniqueid'])): ?>
					<?php foreach ($player['User']['Uniqueid'] as $uniqueid): ?>						
						<?php if ($this->data['Team']['game_id'] == $uniqueid['game_id']) echo $uniqueid['value']; ?>
					<?php endforeach; ?>
					<?php endif; ?>
					<?php if (empty($player['User']['Uniqueid'])): ?>
						<?php __("Player has no uniqueids"); ?>
					<?php endif; ?>
				</td>


				<td class="actions">	
					<table cellspacing="0" cellpadding="0">
						<tr>
							<td style="vertical-align: middle;">
								<?php echo $html->image('/img/orgs/member.png') ?>
							</td>
							<td style="vertical-align: middle;">
								<?php echo $html->link(__('View', true), array('controller' => 'users','action'=>'view', $player['User']['id'])); ?>	
							</td>																
						</tr>
					</table>					
				</td>
				<td class="actions">	
					<table cellspacing="0" cellpadding="0">
						<tr>
							<td style="vertical-align: middle;">
								<?php echo $html->image('/img/orgs/del.png') ?>
							</td>
							<td style="vertical-align: middle;">
								<?php echo $html->link(__('Delete', true), array('controller' => 'teams','action'=>'uninvite', $this->data['Team']['id'], $player['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $player['User']['name'])); ?>	
							</td>																
						</tr>
					</table>										
				</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php else:?>
		<?php echo $html->image('/img/exclamation2.jpg');?>&nbsp;<?php __("Team has no members yet."); ?>
	<?php endif;?>
	</div>
	<br/>
	<div class="teamplayers form">
		
			<?php echo $form->create('Team', array('action'=>'invite'));?>
						
					<?php echo $ajax->autocomplete('User.name', '/users/autocomplete', array('class' => 'auto', 'minChars' => 1)); ?>			
							
					<?php echo $form->input('team_id', array('type'=>'hidden', 'value'=>$this->data['Team']['id']));
				?>
			<br/>
			<br/>
			<?php echo $form->end(strtoupper(__('Invite', true)));?>
		
	</div>
	
	<?php endif;?>
	
	</td>
</tr>

</table>
</div>

