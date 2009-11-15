<?php
 echo $javascript->link('prototype');
 echo $javascript->link('effects');
 echo $javascript->link('scriptaculous');  
 
 echo $javascript->link('controls');
 
?>


<div class="view">


<table class="list" cellpadding="5px" cellspacing="5px" border="0" width="100%">
<tr>
<td valign="top" width="40%">
	<div class="Orgs form">
		<div class="caption">
			<?php __('Org properties');?>
		</div>
		<br/>
		<?php echo $form->create('Org', array('action' => 'edit'));?> 		
		<?php
			echo $form->input('name', array('label'=>__('Title', true)));

			
			echo $form->input('user_id',array('type'=>'hidden'));		

			echo $form->input('id');

			echo $form->input('website');
			
			echo $form->input('irc', array('label' => 'IRC'));
			?>
		</div>
		<br/>
		<?php echo $form->end(strtoupper(__('Submit', true)));?>
	
</td>

 <td style="width:5%;">&nbsp;</td> 
 <td rowspan="3" style="vertical-align:top;"  width="55%">
 
		<div class="caption">
		<?php __('Logo');?>
		</div>
		<br/>
		<?php if ($org['logo_url']): ?>
			<img src="<?php echo $org['logo_url']; ?>" />					
		<?php else: ?>
			<img src="/img/uploads/logos/no_logo.jpg" />									
		<?php endif; ?>
		
		<?php echo $form->create('Org', array('type' => 'file', 'action' => 'upload'));?>		
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


	<div class="members form">	

	<div class="caption">
		<?php __('Org members');?>
	</div>
	<br/>	
	
	<?php if (count($members) > 0):?>
	<table cellpadding="1" cellspacing="1">
		<tr>			
			<th><?php __('Name');?></th>
			
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
		<?php if ($player['User']['id'] != $org['user_id']): ?>
			<tr<?php echo $class;?>>
				<td>
					<?php echo $player['User']['name'];?> <?php if ($player['Staff']['status'] == 'invited') { echo '('.__('Not accepted yet',true) . ')';}?>
				</td>
				

			
				<td class="actions">	
					<table cellspacing="0" cellpadding="0">
						<tr>
							<td style="vertical-align: middle;">
								<?php echo $html->image('/img/orgs/del.png') ?>
							</td>
							<td style="vertical-align: middle;">
								<?php echo $html->link(__('Delete', true), array('controller' => 'Orgs','action' => 'uninvite', $this->data['Org']['id'], $player['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $player['User']['name'])); ?>	
							</td>																
						</tr>
					</table>					
				</td>
				<td class="actions">	
					<table cellspacing="0" cellpadding="0">
						<tr>
							<td style="vertical-align: middle;">								
								<?php if ($player['Staff']['position'] == 'admin'): ?>
									<?php echo $html->image('/img/orgs/promote.png') ?>
								<?php endif; ?>
								
								<?php if ($player['Staff']['position'] == 'headadmin'): ?>
									<?php echo $html->image('/img/orgs/demote.png') ?>
								<?php endif; ?>									
							</td>
							<td style="vertical-align: middle;">
								<?php if ($player['Staff']['position'] == 'admin'): ?>
									<?php echo $html->link(__('Promote to head admin', true), array('controller' => 'Orgs','action'=>'promote', $this->data['Org']['id'], $player['User']['id'], 'headadmin'), array('title' => __("Will be able to change organization settings, invite new members", true))); ?>
								<?php endif; ?>
								
								<?php if ($player['Staff']['position'] == 'headadmin'): ?>
									<?php echo $html->link(__('Demote to admin', true), array('controller' => 'Orgs','action'=>'promote', $this->data['Org']['id'], $player['User']['id'], 'admin'),  null ); ?>
								<?php endif; ?>	
							</td>																
						</tr>
					</table>										
				</td>
			</tr>
		<?php endif; ?>
	<?php endforeach; ?>
	</table>
	<?php else:?>
		<?php echo $html->image('/img/exclamation2.jpg');?>&nbsp;<?php __("Org has no members yet."); ?>
	<?php endif;?>
	</div>
	<br/>
			
	<div class="Orgplayers form">
		
			<?php echo $form->create('Org', array('action'=>'invite'));?>
						
					<?php echo $ajax->autocomplete('user_name', '/users/autocomplete', array('class' => 'auto', 'minChars' => 1)); ?>
							
					<?php echo $form->input('org_id', array('type'=>'hidden', 'value'=>$this->data['Org']['id']));
				?>
			<br/>
			<br/>
			<?php echo $form->end(strtoupper(__('Invite', true)));?>
		
	</div>

	
	</td>
</tr>

</table>
</div>

