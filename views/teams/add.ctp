<div class="view">
<table class="contentpaneopen">
<tr>
<td valign="top">
	<div class="teams form">
	

		<?php echo $form->create('Team');?> 		
		<?php			
			echo $form->input('game_id');
		
			echo $form->input('name', array("label" => __("Team title", true)));
			
			echo $form->input('tag');
			
			echo $form->label('Add me as a player');
			
			echo $form->checkbox('addowner', array ("value" => "1", "checked" => true));						
			
			echo $form->label(__('Clan type', true) . '*');
			
			echo $form->select('type', array('mix'=>'mix', 'clan'=>'clan', 'vip'=>'vip'), 'mix', array(), false);
			
			echo $form->input('user_id',array('type'=>'hidden', 'value'=>$user['User']['id']));		
			
			
		?>
		<br/>
		
		*<?php __('Mix - for team consisting of unregistered players. Clan - all members must be registered users.');?>
		<br/>
		<br/>
		<?php echo $form->end(strtoupper(__('Submit',true)));?>

	
	</div>
	</td>
</tr>
</table>
</div>
