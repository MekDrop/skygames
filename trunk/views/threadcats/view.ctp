<div class="view list">
	<table>
		<tr>
			<td colspan="2">
				<h4>
					<?php echo $html->link(__('All', true), array('controller'=> 'threadcats', 'action'=>'index')); ?> -> <?php echo $threadcat['Threadcat']['name']; ?>
				</h4>
			</td>
		</tr>
	</table>
</div>
<br/>
<div class="related">
	
	<?php if (!empty($threadcat['Thread'])):?>
	<table cellpadding = "3" cellspacing = "0" class="list">
		<tr>
			<td><?php __('Title'); ?></td>
			<td><?php __('Posts'); ?></td>		
			<td><?php __('Created'); ?></td>			
			<td><?php __('Author'); ?></td>
		</tr>
	<?php
		$i = 0;
		foreach ($threads as $thread):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>			
			<td><?php echo $html->link($thread['Thread']['title'], array('controller'=> 'threads', 'action'=>'view', $thread['Thread']['id'])); ?></td>
			<td><?php echo count($thread['Post']);?></td>		
			<td><?php echo substr($thread['Thread']['created'],2,14);?></td>			
			<td><?php echo $html->link($thread['User']['username'], array('controller'=> 'users', 'action'=>'view', $thread['User']['id'])); ?></td>
		</tr>
	<?php endforeach; ?>
	</table>
	<br/>
<?php endif; ?>
	<?php if($othAuth->sessionValid()): ?>
	<div class="list">
		<?php echo $form->button(strtoupper(__('New Thread', true)), array("class"=>"knopke", "div"=>false, "onclick"=>"window.location='" . $html->url(array('controller'=> 'threads', 'action'=>'add', $threadcat['Threadcat']['id'])) . "'")); ?>
	</div>
	<?php else: ?>
	<div class="infocomments form">		
		<?php __("Logon if you want to create a thread"); ?>
	</div>
	<?php endif; ?>
</div>
