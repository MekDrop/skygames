<div class="matches form">
<?php echo $form->create('Match');?>
	<fieldset>
 		<legend><?php __('Edit Match');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('team1_id');
		echo $form->input('team2_id');
		echo $form->input('event_id');
		echo $form->input('tposition_x');
		echo $form->input('tposition_y');
		echo $form->input('playofftable_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Match.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Match.id'))); ?></li>
		<li><?php echo $html->link(__('List Matches', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Events', true), array('controller'=> 'events', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Event', true), array('controller'=> 'events', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Teams', true), array('controller'=> 'teams', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Team1', true), array('controller'=> 'teams', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Playofftables', true), array('controller'=> 'playofftables', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Playofftable', true), array('controller'=> 'playofftables', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Results', true), array('controller'=> 'results', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Result', true), array('controller'=> 'results', 'action'=>'add')); ?> </li>
	</ul>
</div>
