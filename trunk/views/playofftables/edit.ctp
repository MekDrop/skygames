<div class="playofftables form">
<?php echo $form->create('Playofftable');?>
	<fieldset>
 		<legend><?php __('Edit Playofftable');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('events_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Playofftable.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Playofftable.id'))); ?></li>
		<li><?php echo $html->link(__('List Playofftables', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Events', true), array('controller'=> 'events', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Event', true), array('controller'=> 'events', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Matches', true), array('controller'=> 'matches', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Match', true), array('controller'=> 'matches', 'action'=>'add')); ?> </li>
	</ul>
</div>
