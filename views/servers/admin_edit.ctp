<div class="servers form">
<?php echo $form->create('Server');?>
	<fieldset>
 		<legend><?php __('Edit Server');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('game_id');
		echo $form->input('cachetime');		
		echo $form->input('last_response');
		echo $form->input('ip');
		echo $form->input('port');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Server.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Server.id'))); ?></li>
		<li><?php echo $html->link(__('List Servers', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?> </li>
	</ul>
</div>
