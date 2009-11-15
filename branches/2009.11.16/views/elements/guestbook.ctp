<div class="comments index">
<div class="caption"><?php __('Guestbook');?></div>
<br />
<?php

$paginator->options(
array('model'=>$commentsModel,'url' => $paginator->params['pass']));

?> <?php if (!empty($comments)):?>
<table cellpadding="2" cellspacing="0" border='0' width='100%'
	class='list'>
	<?php
	$i = 0;
	foreach ($comments as $comment):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr>
		<td><?php echo substr($comment[$commentsModel]['created'], 2, 9);?> <br />
		<?php echo $html->link($comment['User']['username'], array('controller'=>'users','action'=>'view',  $comment['User']['id'])); ?>
		</td>
		<td style="width: auto; vertical-align: top;" rowspan="2"><?php echo $comment[$commentsModel]['body'];?>
		</td>


	</tr>
	<tr>
		<td style="width: 75px;"><?php if ($comment['User']['avatar_url']): ?>
		<img src="<?php echo $comment['User']['avatar_url']; ?>" alt="<?php echo $comment['User']['username']; ?>" /> <?php else: ?>
		<img src="/img/uploads/avatars/no_avatar.gif" alt="" /> <?php endif; ?></td>

	</tr>
	<tr class="altrow">
		<td style="height: 1px;" colspan="2"></td>

	</tr>
	<?php endforeach; ?>
</table>
	<?php else:?>
<div>&nbsp;&nbsp;&nbsp;&nbsp; <?php __("No messages"); ?></div>
	<?php endif; ?> <br />
<div class="paging"><?php echo $paginator->prev('<< '.__('previous', true), array('model' => $commentsModel), null, array('class'=>'disabled'));?>
| <?php echo $paginator->numbers(array('model' => $commentsModel));?> <?php echo $paginator->next(__('next', true).' >>', array('model' => $commentsModel), null, array('class'=>'disabled'));?>
</div>
<br />
	<?php if($othAuth->sessionValid()): ?>
<div class="infocomments form"><?php echo $form->create((isset($controller) ? $controller : null), array('action' => (isset($action) ? $action : 'addcomment')));?>
	<?php echo $form->input($commentsModel.'.'.'body', array('label'=>__('Your message',true), 'cols' => '60')); ?>
	<?php echo $form->input($commentsModel.'.'.$commentParentName, array('type'=>'hidden', 'value'=>$commentParentValue)); ?>
<br />
	<?php echo $form->end(strtoupper(__('Submit', true)));?></div>
	<?php else: ?>
<div class="infocomments form"><?php __("Logon if you want to leave a message"); ?>
</div>
	<?php endif; ?> <br />
</div>
