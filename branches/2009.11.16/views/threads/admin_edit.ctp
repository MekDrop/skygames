<div class="threads form">
<?php echo $form->create('Thread');?>
	<fieldset>
 		<legend><?php __('Edit Thread');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title', array('error' => __('This field is invalid', true)));
		echo $form->input('body', array('error' => __('This field is invalid', true)));
		echo $form->input('user_id');
		echo $form->input('threadcat_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Thread.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Thread.id'))); ?></li>
		<li><?php echo $html->link(__('List Threads', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Threadcats', true), array('controller'=> 'threadcats', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Threadcat', true), array('controller'=> 'threadcats', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Posts', true), array('controller'=> 'posts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Post', true), array('controller'=> 'posts', 'action'=>'add')); ?> </li>
	</ul>
</div>
