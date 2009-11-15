<div class="infocomments form"><?php echo $form->create('Infocomment');?>
<fieldset><legend><?php __('Edit Infocomment');?></legend> <?php
echo $form->input('id');
echo $form->input('body');
echo $form->input('user_id');
echo $form->input('info_id');
?></fieldset>
<?php echo $form->end('Submit');?></div>
<div class="actions">
<ul>
	<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Infocomment.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Infocomment.id'))); ?></li>
	<li><?php echo $html->link(__('List Infocomments', true), array('action'=>'index'));?></li>
	<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Infos', true), array('controller'=> 'infos', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Info', true), array('controller'=> 'infos', 'action'=>'add')); ?>
	</li>
</ul>
</div>
