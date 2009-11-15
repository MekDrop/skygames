<div class="view">
	<div class="uniqueids form">
	<?php echo $form->create('Uniqueid');?>
	
		<?php
			echo $form->input('id');			
			echo $form->input('game_id');
			echo $form->input('value');
		?>
	<br/>
	<?php echo $form->end(strtoupper(__('Submit', true)));?>
	</div>
</div>

