<div class="feeds form"><?php echo $form->create('Feed');?>
<fieldset><legend><?php __('Add Feed');?></legend> <?php
echo $form->input('name');
echo $form->input('url');
echo $form->input('show');
echo $form->select('game_id');
?></fieldset>
<?php echo $form->end('Submit');?></div>
<div class="actions">
<ul>
	<li><?php echo $html->link(__('List Feeds', true), array('action'=>'index'));?></li>
	<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?>
	</li>
</ul>
</div>
