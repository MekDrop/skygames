<div class="view">
<table class="contentpaneopen">
<tr>
<td valign="top">
	<div class="teamplayers form">
 		
		<?php echo $form->create('Teamplayer');?>
			
			<?php echo $form->input(__('name', true));?>
						
			<?php echo $form->input(__('mail', true));?>
						
			<?php echo $form->input(__('skype', true));?>
				
			<?php echo $form->input(__('uniqueid', true));?>
					
			<?php echo $form->input('team_id', array('type'=>'hidden', 'value'=>$this->data['Team']['id']));?>
			
			<br/>
			<?php echo $form->end(strtoupper(__('Submit', true)));?>			

	</div >
	</td>
</tr>
</table>
</div >