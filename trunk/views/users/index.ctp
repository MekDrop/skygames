<div class="index">
<table cellpadding="1" cellspacing="1" class="list">
<tr>	
	<th><?php echo $paginator->sort(__('Username', true),'username');?></th>
	<th><?php echo $paginator->sort(__('Email', true),'email');?></th>
	<th><?php echo $paginator->sort(__('Created', true),'created');?></th>
</tr>
<?php
$i = 0;
foreach ($users as $user):
	$class = null;
	if ($i++ % 2 != 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $html->link($user['User']['username'], array('controller'=> 'users', 'action'=>'view', $user['User']['id'])); ?>
		</td>
		<td>
			<?php echo $user['User']['email']; ?>
		</td>
		<td>
			<?php echo substr($user['User']['created'], 0, 10); ?>
		</td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td style="text-align:center" colspan="32">
			<br/>
				<div class="paging">
					<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
				 | 	<?php echo $paginator->numbers();?>
					<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
				</div>					
		</td>
	</tr>
</table>
</div>
