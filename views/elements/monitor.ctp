<?php if (!empty($servers)): ?>
<table cellpadding="2" cellspacing="2">
	<tr>
		<th>&nbsp;</th>
		<th><?php __('Title');?></th>
		<th><?php __('Ip');?></th>
		<th><?php __('Map');?></th>
		<th><?php __('Players');?></th>
		<th><?php __('ms');?></th>
		<th>&nbsp;</th>

	</tr>
	<?php
	$i = 0;
	foreach ($servers as $server):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td style="text-align: center"><?php echo $html->image($server['Game']['icon']); ?>
		</td>
		<td style="text-align: left"><?php echo substr($server['Server']['name'],0,43); ?>
		</td>
		<td style="text-align: left"><?php echo $server['Server']['ip']; ?>:<?php echo $server['Server']['port']; ?>
		</td>
		<td style="text-align: center"><?php echo $server['Server']['map']; ?>
		</td>

		<td style="text-align: center"><?php echo $server['Server']['players']; ?>/<?php echo $server['Server']['maxplayers']; ?>
		</td>
		<td style="text-align: center"><?php echo $server['Server']['ping']; ?>
		</td>
		<td style="text-align: center">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td style="vertical-align: middle;"><?php echo $html->image('/img/servers/view.png') ?>
				</td>
				<td style="vertical-align: middle;"><?php echo $html->link(__("Details", true), array("action" => "view", $server['Server']['id'])); ?>
				</td>
			</tr>
		</table>
		</td>


	</tr>
	<?php endforeach; ?>
</table>
	<?php endif; ?>