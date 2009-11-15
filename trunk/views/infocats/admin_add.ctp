<div class="infocats form">
<?php echo $form->create('Infocat');?>
	<fieldset>
 		<legend><?php __('Add Infocat');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('game_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Infocats', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Infos', true), array('controller'=> 'infos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Info', true), array('controller'=> 'infos', 'action'=>'add')); ?> </li>
	</ul>
</div>
