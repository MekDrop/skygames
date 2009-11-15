<div class="orgs form">
<?php echo $form->create('Org');?>
	<fieldset>
 		<legend><?php __('Edit Org');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('user_id');
		echo $form->input('website');
		echo $form->input('irc');
		echo $form->input('logo');
		echo $form->input('country_id');
		echo $form->input('Staff');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Org.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Org.id'))); ?></li>
		<li><?php echo $html->link(__('List Orgs', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Events', true), array('controller'=> 'events', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Event', true), array('controller'=> 'events', 'action'=>'add')); ?> </li>
	</ul>
</div>
