<div class="index">
<table cellpadding="0" cellspacing="0" style="width: 100%;">

<?php
$i = 0;
foreach ($threadcats as $threadcat):
	$class = null;
	if ($i++ % 2 != 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
		<table cellpadding="3" cellspacing="0" class="list">
			<tr>
			<td>
				<h4><?php echo $html->link($threadcat['Threadcat']['name'], array('controller'=>'threadcats', 'action'=>'view', $threadcat['Threadcat']['id'])); ?></h4>
			</td>
			</tr>
			<tr>
			<td>
				<?php __('Threads count');?>: <?php echo count($threadcat['Thread']); ?>				
			</td>
			</tr>
			<tr>
			<td>
				<?php if (!empty($threadcat['Thread'])): ?>
					<?php __('Last thread');?>: <?php echo $html->link($threadcat['Thread'][0]['title'], array('controller'=>'threads', 'action'=>'view', $threadcat['Thread'][0]['id'])); ?>
				<?php else: ?>
					<?php __('Last thread');?>: <?php __('No threads in this category');?>
				<?php endif; ?>					
			</td>
			</tr>
		</table>
		</td>	
	</tr>
<?php endforeach; ?>
</table>
</div>