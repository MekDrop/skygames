<div class="adminmenus form">
<?php echo $form->create('Adminmenu');?>
	<fieldset>
 		<legend><?php __('Edit Adminmenu');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('link');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Adminmenu.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Adminmenu.id'))); ?></li>
		<li><?php echo $html->link(__('List Adminmenus', true), array('action'=>'index'));?></li>
	</ul>
</div>
