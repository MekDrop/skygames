<div class="infos form"><?php echo $form->create('Info');?>
<fieldset><legend><?php __('Edit Info');?></legend> <?php
echo $form->input('id');
echo $form->input('title');
echo $form->input('desc');
echo $form->input('body');
echo $form->input('user_id');
echo $form->input('infocat_id');
echo $form->input('lang_id');
echo $form->input('game_id');
?></fieldset>
<?php echo $form->end('Submit');?></div>
<div class="actions">
<ul>
	<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Info.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Info.id'))); ?></li>
	<li><?php echo $html->link(__('List Infos', true), array('action'=>'index'));?></li>
	<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Infocats', true), array('controller'=> 'infocats', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Infocat', true), array('controller'=> 'infocats', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Langs', true), array('controller'=> 'langs', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Lang', true), array('controller'=> 'langs', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Games', true), array('controller'=> 'games', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Game', true), array('controller'=> 'games', 'action'=>'add')); ?>
	</li>
	<li><?php echo $html->link(__('List Infocomments', true), array('controller'=> 'infocomments', 'action'=>'index')); ?>
	</li>
	<li><?php echo $html->link(__('New Infocomment', true), array('controller'=> 'infocomments', 'action'=>'add')); ?>
	</li>
</ul>
</div>
