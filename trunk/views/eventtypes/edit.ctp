<div class="eventtypes form"><?php echo $form->create('Eventtype');?>
<fieldset><legend><?php __('Edit Eventtype');?></legend> <?php
echo $form->input('id');
echo $form->input('name');
?></fieldset>
<?php echo $form->end('Submit');?></div>
<div class="actions">
<ul>
	<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Eventtype.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Eventtype.id'))); ?></li>
	<li><?php echo $html->link(__('List Eventtypes', true), array('action'=>'index'));?></li>
	<li><?php echo $html->link(__('List Events', true), array('controller'=> 'events', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Event', true), array('controller'=> 'events', 'action'=>'add')); ?>
	</li>
</ul>
</div>
