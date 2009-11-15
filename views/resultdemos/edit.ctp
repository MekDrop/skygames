<div class="resultdemos form">
<?php echo $form->create('Resultdemo');?>
	<fieldset>
 		<legend><?php __('Edit Resultdemo');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('desc');
		echo $form->input('url');
		echo $form->input('result_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Resultdemo.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Resultdemo.id'))); ?></li>
		<li><?php echo $html->link(__('List Resultdemos', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Results', true), array('controller'=> 'results', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add')); ?> </li>
	</ul>
</div>
