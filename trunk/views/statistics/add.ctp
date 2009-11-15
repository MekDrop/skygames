<div class="statistics form">
<?php echo $form->create('Statistic');?>
	<fieldset>
 		<legend><?php __('Add Statistic');?></legend>
	<?php
		echo $form->input('team_id');
		echo $form->input('matches');
		echo $form->input('maps');
		echo $form->input('won');
		echo $form->input('lost');
		echo $form->input('frags');
		echo $form->input('deaths');
		echo $form->input('events');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Statistics', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Teams', true), array('controller'=> 'teams', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Team', true), array('controller'=> 'teams', 'action'=>'add')); ?> </li>
	</ul>
</div>
