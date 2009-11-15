<div class="betts form">
<?php echo $form->create('Bett');?>
	<fieldset>
 		<legend><?php __('Add Bett');?></legend>
	<?php
		echo $form->input('match_id', array("value" => $match_id));
		echo $form->input('team_id', array("value" => $team_id));
		echo $form->input('sum');
		echo $form->input('odds', array("type" => "hidden"));		
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Betts', true), array('action'=>'index'));?></li>
	</ul>
</div>
