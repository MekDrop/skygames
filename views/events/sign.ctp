<div class="events form"><?php echo $form->create('Event');?>
<fieldset><legend><?php __('Edit Event');?></legend> <?php
echo $form->input('id');
echo $form->input('name');
echo $form->input('game_id');
echo $form->input('eventtype_id');
echo $form->input('Team');
?></fieldset>
<?php echo $form->end('Submit');?></div>
<div class="actions">
<ul>
	<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Event.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Event.id'))); ?></li>
	<li><?php echo $html->link(__('List Events', true), array('action'=>'index'));?></li>
	<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Eventtypes', true), array('controller'=> 'eventtypes', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Eventtype', true), array('controller'=> 'eventtypes', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Matches', true), array('controller'=> 'matches', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Match', true), array('controller'=> 'matches', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Teams', true), array('controller'=> 'teams', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Team', true), array('controller'=> 'teams', 'action'=>'add')); ?>
	</li>
</ul>
</div>
