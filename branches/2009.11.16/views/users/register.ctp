<div class="view list">
<table class="contentpaneopen">
<tr>
<td valign="top">
	
	

		<?php echo $form->create('User', array('action'=>'register'));?> 		
		<?php
			echo __("Username",true)."</br>";
			echo $form->input('username',array('label'=>''));

			echo __("Password",true)."</br>";
			echo $form->input('password', array('label'=>''));
			
			echo __("Email",true)."</br>";
			echo $form->input('email' ,array('label'=>''));			
		?>
		<br/>
		<?php echo $form->end(strtoupper(__('Submit', true)));?>

	
	
</td>	
</tr>

</table>
</div>