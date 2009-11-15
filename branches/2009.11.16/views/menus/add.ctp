<div class="menus form">
<?php echo $form->create('Menu');?>
	<fieldset>
 		<legend><?php __('Add Menu');?></legend>
	<?php
		echo $form->input('title');
		echo $form->input('link');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Menus', true), array('action'=>'index'));?></li>
	</ul>
</div>
