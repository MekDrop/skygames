<div class="games form">
<?php echo $form->create('Game');?>
	<fieldset>
 		<legend><?php __('Edit Game');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('icon');
		echo $form->input('avatar');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Game.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Game.id'))); ?></li>
		<li><?php echo $html->link(__('List Games', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Events', true), array('controller'=> 'events', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Event', true), array('controller'=> 'events', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Matchparts', true), array('controller'=> 'matchparts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Matchpart', true), array('controller'=> 'matchparts', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Gamewords', true), array('controller'=> 'gamewords', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Gameword', true), array('controller'=> 'gamewords', 'action'=>'add')); ?> </li>
	</ul>
</div>
