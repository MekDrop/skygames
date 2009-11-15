
<table style="width: 100%;">
<tr>
<td style="width: 100%;vertical-align:middle;text-align:center;">	
															
		<?php echo $form->create('Award', array('url' => '/events/award', 'id' => 'AwardCreateForm'));?>	 
			<?php
				echo $form->input('event_id', array('type' => 'hidden'));
				echo $form->label('nomination_id',__("Award", true));
				echo $form->select('nomination_id', $nominations, null, array(), false);
			?>	
			<br/>
			<br/>
			<?php	
				echo $form->label('team_id',__("Team", true));
				echo $form->select('team_id', $teamList, null, array(), false);												
			?>	
		<br/>
		<br/>
			<br/>
		<?php echo $form->button(__('Submit', true), array('onClick' => "getElementById('AwardCreateForm').submit(); closeWindow();"));?>
	
	<br/>														
</td>
</tr>
</table>
