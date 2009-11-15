<div class="view list" style="text-align:center;vertical-align:top">
<div>
	<?php __("We will send you a new password. Please type your email"); ?>
</div>
<br/>
<table class="contentpaneopen" width="100%">
<tr>
<td style="text-align:center;vertical-align:top">

		<?php echo $form->create('User', array('action'=>'reset'));?> 		
		<?php
			echo $form->input('email');			
		?>
		<br/>
		<?php echo $form->end(strtoupper(__('Submit', true)));?>

</td>	
</tr>

</table>
</div>