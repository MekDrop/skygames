<?php
$channel = $this->requestAction('feeds/show');
if (count($channel) > 0)
$channel = array_slice($channel, 0, 6);
?>

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
				<b><?php __("eSPORTS"); ?></b></font></td>
			</tr>
			<tr>
				<td style="width: 214px; vertical-align: top;">
				<table align="left" cellspacing="0" cellpadding="0"
					style="width: 214px; height: 112px; vertical-align: top;">
					<tr>
						<td
							style="width: 7px; background-image: url('/img/didelelentelekaire.jpg');">
						</td>
						<td style="width: 200px; vertical-align: top;"><?php if (!empty($channel)): ?>
						<table cellpadding="2" cellspacing="2" class="list" width="100%">
						<?php
						$i = 0;
						foreach ($channel as $item):
						$class = ' class=""';
						if ($i++ % 2 == 0) {
							$class = ' class="altrow"';
						}
						?>
							<tr>
								<td style='text-align: top; font-size: 9px'><b><?php echo $html->link(substr(htmlspecialchars_decode($item['title'], ENT_QUOTES),0,255), $item['link'], array("target" => "_blank")); ?><?php if (strlen($item['title']) > 255) {echo "...";} ?></b>&nbsp;
								</td>
							</tr>
							<tr>
								<td style='text-align: top; font-size: 9px'><?php echo str_replace("align='right'", "align='left'", str_replace("<img", "<img  style='margin: 0px 5px 5px 0px;width:81px;height:54px;'", htmlspecialchars_decode($item['description'], ENT_QUOTES))); ?>
								<br />
								<i><?php echo substr(date("Y-m-d",strtotime($item['pubDate'])),0); ?></i>&nbsp;<?php __("by"); ?>&nbsp;<?php echo $item['source']; ?>&nbsp;
								</td>
							</tr>

							<?php endforeach; ?>
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




