<div class="teams index">
<table cellpadding="1" cellspacing="1" class="list" >
<tr>
	<th><?php echo $paginator->sort(__('Created', true), 'created');?></th>
	<th><?php echo $paginator->sort(__('Game', true), 'game_id');?></th>
	<th><?php echo $paginator->sort(__('Name', true), 'name');?></th>
	<th><?php __('Teamsize', true);?></th>
	<th><?php echo $paginator->sort(__('Owner', true), 'user_id');?></th>
</tr>
<?php
$i = 0;
foreach ($teams as $team):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo substr($team['Team']['created'], 0, 10); ?>
		</td>
		<td style="text-align:center;">
			<?php if ($team['Game']['icon']) { echo $html->image($team['Game']['icon']); } ?>
		</td>		
		<td>
			<?php echo $html->link($team['Team']['name'], array('action'=>'view', $team['Team']['id'])); ?>
		</td>
		<td style="text-align:center;">
			<?php if (!empty($team['Teamplayer'])) { echo count($team['Teamplayer']); } elseif (!empty($team['Member'])) { echo count($team['Member']); } ?>
		</td>	
		<td>
			<?php echo $html->link($team['User']['username'], array('controller'=> 'users', 'action'=>'view', $team['User']['id'])); ?>
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
					<?php
				echo $paginator->counter(array(
				'format' => __('%page%/%pages%', true)
				));
				?>
				</div>
					
		</td>
	</tr>
</table>
</div>


