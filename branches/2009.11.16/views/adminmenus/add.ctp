<div class="adminmenus form"><?php echo $form->create('Adminmenu');?>
<fieldset><legend><?php __('Add Adminmenu');?></legend> <?php
echo $form->input('title');
echo $form->input('link');
?></fieldset>
<?php echo $form->end('Submit');?></div>
<div class="actions">
<ul>
	<li><?php echo $html->link(__('List Adminmenus', true), array('action'=>'index'));?></li>
</ul>
</div>
