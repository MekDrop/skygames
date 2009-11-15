<div class="matchparts form">
<?php echo $form->create('Matchpart');?>
	<fieldset>
 		<legend><?php __('Edit Matchpart');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('game_id');
		echo $form->input('constant');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Matchpart.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Matchpart.id'))); ?></li>
		<li><?php echo $html->link(__('List Matchparts', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Results', true), array('controller'=> 'results', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add')); ?> </li>
	</ul>
</div>
