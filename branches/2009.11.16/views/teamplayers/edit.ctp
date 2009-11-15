<?php
  echo $javascript->link('popup');  
?>
<div class="view">
<table class="contentpaneopen">
<tr>
<td valign="top">
	<div class="teamplayers form"> 		
		<?php echo $form->create('Teamplayer');			
			echo $form->input('name');
			echo $form->input('mail');
			echo $form->input('skype');
			echo $form->input('uniqueid');
					
			echo $form->input('team_id', array('type'=>'hidden', 'value'=>$this->data['Team']['id']));?>			
			<br/>
			<br/>
			<?php echo $form->button(__('Submit', true), array('onClick' => "getElementById('TeamplayerEditForm').submit(); "));?>
			<br/>
			
			<?php echo $form->end();?>			
	</div >
	</td>
</tr>
</table>
</div >