<div class="results form">
<?php echo $form->create('Result');?>
	<fieldset>
 		<legend><?php __('Edit Result');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('team1_score');
		echo $form->input('team2_score');
		echo $form->input('matchpart_id');
		echo $form->input('match_id');
		echo $form->input('map_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Result.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Result.id'))); ?></li>
		<li><?php echo $html->link(__('List Results', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Matchparts', true), array('controller'=> 'matchparts', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Matchpart', true), array('controller'=> 'matchparts', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Matches', true), array('controller'=> 'matches', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Match', true), array('controller'=> 'matches', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Maps', true), array('controller'=> 'maps', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Map', true), array('controller'=> 'maps', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Resultdemos', true), array('controller'=> 'resultdemos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Resultdemo', true), array('controller'=> 'resultdemos', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Resultpictures', true), array('controller'=> 'resultpictures', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Resultpicture', true), array('controller'=> 'resultpictures', 'action'=>'add')); ?> </li>
	</ul>
</div>
