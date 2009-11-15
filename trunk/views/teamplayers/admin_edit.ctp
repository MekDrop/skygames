<div class="teamplayers form">
<?php echo $form->create('Teamplayer');?>
	<fieldset>
 		<legend><?php __('Edit Teamplayer');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('mail');
		echo $form->input('skype');
		echo $form->input('uniqueid');
		echo $form->input('team_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Teamplayer.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Teamplayer.id'))); ?></li>
		<li><?php echo $html->link(__('List Teamplayers', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Teams', true), array('controller'=> 'teams', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Team', true), array('controller'=> 'teams', 'action'=>'add')); ?> </li>
	</ul>
</div>
