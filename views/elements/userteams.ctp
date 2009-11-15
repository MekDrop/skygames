<?php $userteams = $this->requestAction('teams/userteams'); ?>

<div class="list">


<table align="left" cellspacing="0" cellpadding="0"
	style="width: 214px; vertical-align: top;">
	<tr>
		<td
			style="width: 214px; height: 160px; text-align: left; vertical-align: top;">
		<table align="left" cellspacing="0" cellpadding="0"
			style="width: 214px; vertical-align: top;">
			<tr>
				<td
					style="background-image: url('/img/mazalentelevirsus214.jpg'); width: 214px; height: 35px; vertical-align: middle; text-align: center;">
				<font
					style="font-weight: bold; font-family: tahoma; font-size: 11px; color: #616464;">
				<b><?php __("User teams"); ?></b></font></td>
			</tr>
			<tr>
				<td style="width: 214px; vertical-align: top;">
				<table align="left" cellspacing="0" cellpadding="0"
					style="width: 214px; height: 112px; vertical-align: top;">
					<tr>
						<td
							style="width: 7px; background-image: url('/img/didelelentelekaire.jpg');">
						</td>
						<td style="width: 200px; vertical-align: top;"><?php if (!empty($userteams)): ?>
						<table cellpadding="2" cellspacing="2" class="list" width="100%">
							<tr>
								<td><?php foreach($userteams as $index => $team):?> <b>&raquo;</b>
								<?php echo $html->link(__('Edit', true) .' '.$team['Team']['name'], array('controller'=>'teams', 'action'=>'edit', $team['Team']['id'])); ?>
								<br />
								<?php endforeach; ?></td>
							</tr>

						</table>
						<?php endif; ?></td>
						<td
							style="width: 7px; background-image: url('/img/didelelenteledesine.jpg');">
						</td>

					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td
					style="background-image: url('/img/mazalenteleapacia214.jpg'); width: 214px; height: 19px; vertical-align: middle; text-align: left;">
				</td>
			</tr>
		</table>
		</td>
	</tr>

</table>

</div>
