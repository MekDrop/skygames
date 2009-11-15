<div class="teams form">
<?php echo $form->create('Team');?>
	<fieldset>
 		<legend><?php __('Add Team');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('tag');
		echo $form->input('user_id');
		echo $form->input('game_id');
		echo $form->input('type');
		echo $form->input('tag');
		echo $form->input('Event');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Teams', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Events', true), array('controller'=> 'events', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Event', true), array('controller'=> 'events', 'action'=>'add')); ?> </li>
	</ul>
</div>
