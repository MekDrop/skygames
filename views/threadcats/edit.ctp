<div class="threadcats form">
<?php echo $form->create('Threadcat');?>
	<fieldset>
 		<legend><?php __('Edit Threadcat');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('game_id');
		echo $form->input('lang_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Threadcat.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Threadcat.id'))); ?></li>
		<li><?php echo $html->link(__('List Threadcats', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Langs', true), array('controller'=> 'langs', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Lang', true), array('controller'=> 'langs', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Threads', true), array('controller'=> 'threads', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Thread', true), array('controller'=> 'threads', 'action'=>'add')); ?> </li>
	</ul>
</div>
