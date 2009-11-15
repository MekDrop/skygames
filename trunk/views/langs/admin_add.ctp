<div class="langs form">
<?php echo $form->create('Lang');?>
	<fieldset>
 		<legend><?php __('Add Lang');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('code');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Langs', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Gamewords', true), array('controller'=> 'gamewords', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Gameword', true), array('controller'=> 'gamewords', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Infos', true), array('controller'=> 'infos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Info', true), array('controller'=> 'infos', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Threadcats', true), array('controller'=> 'threadcats', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Threadcat', true), array('controller'=> 'threadcats', 'action'=>'add')); ?> </li>
	</ul>
</div>
