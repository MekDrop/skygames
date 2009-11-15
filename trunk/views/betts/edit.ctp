<div class="betts form"><?php echo $form->create('Bett');?>
<fieldset><legend><?php __('Edit Bett');?></legend> <?php
echo $form->input('id');
echo $form->input('match_id');
echo $form->input('team_id');
echo $form->input('sum');
echo $form->input('odds');
echo $form->input('user_id');
?></fieldset>
<?php echo $form->end('Submit');?></div>
<div class="actions">
<ul>
	<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Bett.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Bett.id'))); ?></li>
	<li><?php echo $html->link(__('List Betts', true), array('action'=>'index'));?></li>
</ul>
</div>
