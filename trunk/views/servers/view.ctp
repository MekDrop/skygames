<div class="servers view">

<table width="100%">
	<tr>
		<td style="text-align:left;vertical-align:top">
			<table class="list" >
				<tr>
					<td>
						<?php __('Game'); ?>
					</td>
					<td>
						<?php echo $server['Game']['name']; ?>
					</td>			
				</tr>
				<tr>
					<td>
						<?php __('Registered'); ?>
					</td>
					<td>
						<?php echo $server['Server']['created']; ?>
					</td>			
				</tr>		
				<tr>
					<td>
						<?php __('IP'); ?>
					</td>
					<td>
						<?php echo $server['Server']['ip']; ?>
					</td>			
				</tr>
				<tr>
					<td>
						<?php __('Port'); ?>
					</td>
					<td>
						<?php echo $server['Server']['port']; ?>
					</td>			
				</tr>	
				<tr>
					<td>
						<?php __('Ping'); ?>
					</td>
					<td>
						<?php echo $info['s']['query_time']; ?>
					</td>			
				</tr>			
				<tr>
					<td>
						<?php __('Map'); ?>
					</td>
					<td>
						<?php echo $info['s']['map']; ?>
					</td>			
				</tr>	
			</table>	
		</td>
		<td style="text-align:left">
			<?php echo $html->image('/img/maps/'.$info['b']['type'].'/'.$info['s']['game'].'/'.$info['s']['map'].'.jpg'); ?>
		</td>
	</tr>
	</table>
	<br/>
	<br/>
	<div class="caption">
		<?php __("Players"); ?>
	</div>	
	<br/>
	<br/>
	<table cellpadding="1" cellspacing="1" class="list">
	<tr>	
		<th><?php __('Name'); ?></th>
		<th><?php __('Frags'); ?></th>
		<th><?php __('Time'); ?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($players as $player):
		$class = null;
		if ($i++ % 2 != 0) {
			$class = ' class="altrow"';
		}
	?>
		<tr<?php echo $class;?>>
			<td>
				<?php echo $player['name']; ?>
			</td>
			<td>
				<?php echo $player['score']; ?>
			</td>
			<td>
				<?php if (isset($player['time'])) echo $player['time']; ?>
			</td>
		</tr>
	<?php endforeach; ?>		
	</table>
	
</div>

	<br/>
	<br/>
	<?php echo $this->renderElement('comments', array('cache'=>false, 'commentsModel' => 'Servercomment', 'commentParentName' => 'server_id', 'commentParentValue' => $server['Server']['id']));?>

