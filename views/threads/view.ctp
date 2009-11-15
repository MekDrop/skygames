<div class="view list">
	<table>
		<tr>
			<td>
				<h4><?php echo $html->link(__('All', true), array('controller'=> 'threadcats', 'action'=>'index')); ?> -> <?php echo $html->link($thread['Threadcat']['name'], array('controller'=> 'threadcats', 'action'=>'view', $thread['Threadcat']['id'])); ?> -> <?php echo $thread['Thread']['title']; ?></h4>
			</td>
		</tr>
	</table>
</div>

<div class="related">
	
	<table cellpadding = "2" cellspacing = "0" border='0 ' width='100%' class='list'>
		<tr>
			<td style="width:80px;"><?php echo substr($thread['Thread']['created'],5,11);?>
				<br/><?php echo $html->link($thread['User']['username'], array('controller'=> 'users', 'action'=>'view', $thread['User']['id'])); ?>
			</td>				
			<td> &nbsp; </td>		
		</tr>
		<tr>
			<td style="width:80px;vertical-align:top">							
				<?php if ($thread['User']['avatar_url']): ?>
					<img src="<?php echo $thread['User']['avatar_url']; ?>" />					
				<?php else: ?>
					<img src="/img/uploads/avatars/no_avatar.gif" />									
				<?php endif; ?>
			</td>
			<td style="test-align:left;vertical-align: top;"><?php echo $thread['Thread']['body']; ?></td>	
		</tr>
		<tr>
			<td colspan="2"><hr/></td>
		</tr>
		<?php if (!empty($thread['Post'])):?>
		<?php
		$i = 0;
		foreach ($posts as $post):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>		
		
		<tr<?php echo $class;?>>
			<td style="width:80px;">
				<?php echo substr($post['Post']['created'], 5, 11);?>
				<br/>
				<?php echo $html->link($post['User']['username'], array('controller'=>'users','action'=>'view',  $post['User']['id'])); ?>				
			</td>		
			
			<td> <?php echo $post['Post']['title']; ?></td>
		</tr>
		<tr<?php echo $class;?>>
			<td style="width:80px;vertical-align:top">
				
				
				<?php if ($post['User']['avatar_url']): ?>
					<img src="<?php echo $post['User']['avatar_url']; ?>" />					
				<?php else: ?>
					<img src="/img/uploads/avatars/no_avatar.gif" />									
				<?php endif; ?>
			</td>
			<td style="test-align:left;vertical-align: top;">
				<?php echo $post['Post']['body'];?>
			</td>
		
		</tr>
		<?php endforeach; ?>
		<?php endif; ?>
	</table>

	<br/>
	<?php if($othAuth->sessionValid()): ?>
	<div class="infocomments form">
	<fieldset>
		<?php echo $form->create('Post');?>			 	
		<?php echo $form->input('body', array('label'=>__('Your post',true), 'cols' => '60')); ?>
		<?php echo $form->input('thread_id', array('type'=>'hidden','value'=>$thread['Thread']['id'])); ?>
		<br/>
		<?php echo $form->end(strtoupper(__('Submit', true)));?>		
	</fieldset>	
	</div>
	<?php else: ?>
	<div class="infocomments form">		
		<?php __("Logon if you want to comment"); ?>
	</div>
	<?php endif; ?>
</div>
