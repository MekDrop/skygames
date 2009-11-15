<?php
	$events = $this->requestAction('events/latest');
	$infos = $this->requestAction('infos/latest');	
	$threads = $this->requestAction('threads/latest');
	$matches = $this->requestAction('matches/latest');
?>

<table align="left" cellspacing="0" cellpadding="0" style="width: 697px; vertical-align: top;text-align: center;">
<tr>
	<td style="background-image: url('/img/kairyssonas.jpg'); width: 9px; height: 154px;">
	</td>
	<td style="vertical-align: top;">
		<table align="left" cellspacing="0" cellpadding="0" style="vertical-align: top; text-align: center;">
			<tr>
				<td style="background-image: url('/img/melynaeilutevirsutine.jpg'); width: px; height: 23px;">
					<font style="font-weight: bold; font-family: tahoma; font-size: 11px; color: #c6f3fb;">
						<?php echo strtoupper(__("Events", true)); ?>
					</font>
				</td>
			</tr>
			<tr>
				<td style="background-color: #bee7f2; width: 204px; height: 131px; vertical-align: top">
					<table align="left" cellspacing="0" cellpadding="0" style="vertical-align: top; text-align: left;">
						<tr>
							<td class="tarpelisdesinetext" style="height: 5px;">
								
							</td>
						</tr>
						
						<?php
						$i = 0;
						foreach ($events as $event):
						$i++;
						?>
							<tr>
								<td class="kairepusetekstas">								
									<?php echo $html->image($event['Game']['icon'], array("width"=>"13", "height"=>"13")); ?>&nbsp;
								</td>
								<td class="kairepusetekstas">										
									<?php echo $html->link(substr($event['Event']['name'],0,17), array('controller'=> 'events', 'action'=>'view', $event['Event']['id'])); ?>
									<?php if (strlen($event['Event']['name']) > 17) { echo "..."; } ?>										
									[<?php if ($event['Event']['status'] == 'signup'):?>
										<font color="green"><?php echo $html->link(__("Sign-up", true), array('controller'=> 'events', 'action'=>'sign', $event['Event']['id'])); ?></font>
									<?php endif; ?>
									<?php if ($event['Event']['status'] == 'active'):?>
										<?php echo $html->link(__("Active", true), array('controller'=> 'events', 'action'=>'view', $event['Event']['id'])); ?>
									<?php endif; ?>
									<?php if ($event['Event']['status'] == 'finished'):?>
										<?php echo $html->link(__("Finished", true), array('controller'=> 'events', 'action'=>'view', $event['Event']['id'])); ?>
									<?php endif; ?>		
									<?php if ($event['Event']['status'] == 'closed'):?>
										<?php echo $html->link(__("Stoped", true), array('controller'=> 'events', 'action'=>'view', $event['Event']['id'])); ?>
									<?php endif; ?>]		
								</td>						
							</tr>							
							<?php if ($i != count($events)): ?><tr><td class="tarpeliskaire" colspan="3"></tr><?php endif; ?>
							<?php endforeach; ?>
						
							
				
						
						</table>
					</td>
				</tr>
			</table>
		</td>
		<td style="vertical-align: top; text-align: center;">
			<table cellspacing="0" cellpadding="0" style="vertical-align: top; text-align: center;">
				<tr>
					<td style="background-image: url('/img/kairesnismelynas.jpg'); width: 12px; height: 154px;">
					</td>
					<td style="height: 154px; vertical-align: top;">
						<table cellspacing="0" cellpadding="0" style="width: 125px; vertical-align: top;
							text-align: center;">
							<tr>
								<td style="text-align: right; vertical-align: middle; width: 125px; height: 25px;
									background-image: url('/img/virsesnismelynas.jpg');">
									<font style="font-weight: bold; font-family: tahoma; font-size: 11px; color: #defaff;">
										<?php echo strtoupper(__("News", true)); ?></font>&nbsp;&nbsp;
								</td>
							</tr>
							<tr>
								<td style="background-color: #03bfec; width: 12px; height: 129px; text-align: right;
									vertical-align: top;">
									<table cellspacing="0" cellpadding="0" style="width: 125px; vertical-align: top;
										text-align: right;">
										<?php
										$i = 0;
										foreach ($infos as $info):
										$class = ' class="biskikairiautekstas"';
										if ($i++ % 2 == 0) {
											$class = ' class="biskikairiautekstas_alt"';
										}	
										?>
											<tr>
												<td<?php echo $class;?> style="color:#defaff;">			
													<?php echo $html->link(substr($info['Info']['title'],0,18), array('controller'=>'infos','action'=>'view', $info['Info']['id']), array('style'=>'font-weight: bold;color:#defaff;')); ?><?php if (strlen($info['Info']['title']) > 18) {echo "...";} ?>&nbsp;<br/>
													<i><?php echo substr($info['Info']['created'],0,10); ?></i>&nbsp;<?php __("-"); ?>&nbsp;<?php echo $info['User']['name']; ?>&nbsp;			
												</td>						
											</tr>
											
										<?php endforeach; ?>	
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td style="height: 152px; width: 2px; background-image: url('/img/skiriamojijuosta.jpg');">
					</td>
					<td style="height: 154px; vertical-align: top;">
						<table cellspacing="0" cellpadding="0" style="width: 125px; vertical-align: top;
							text-align: center;">
							<tr>
								<td style="text-align: left; vertical-align: middle; width: 125px; height: 25px;
									background-image: url('/img/virsesnismelynas.jpg');">
									&nbsp;&nbsp;<font style="font-weight: bold; font-family: tahoma; font-size: 11px;
										color: #c6f3fb;"><?php echo strtoupper(__("Last threads", true)); ?></font>&nbsp;&nbsp;
								</td>
							</tr>
							<tr>
								<td style="background-color: #03bfec; width: 12px; height: 129px; text-align: left;
									vertical-align: top;">
									<table cellspacing="0" cellpadding="0" style="width: 125px; vertical-align: top;
										text-align: left;">									
										<?php
										$i = 0;
										foreach ($threads as $thread):
										$class = ' class="tamsustarpelisdesinetext"';
										if ($i++ % 2 != 0) {
											$class = ' class="tamsustarpelisdesinetext_alt"';
										}	
										?>
											<tr>
												<td<?php echo $class;?> style="color:#defaff;">			
													&nbsp;<?php echo $html->link(substr($thread['Thread']['title'],0,20), array('controller'=>'threads','action'=>'view', $thread['Thread']['id']), array('style'=>'font-weight: bold;color:#defaff;')); ?><?php if (strlen($thread['Thread']['title']) > 20) {echo "...";} ?>&nbsp;<br/>
													&nbsp;<i><?php echo substr($thread['Thread']['created'],0,10); ?></i>&nbsp;<?php __("-"); ?>&nbsp;<?php echo $thread['User']['name']; ?>&nbsp;			
												</td>						
											</tr>
											
										<?php endforeach; ?>																					
									</table>
								</td>
							</tr>
						</table>
					</td>
					<td style="background-image: url('/img/desinesnismelynas.jpg'); width: 12px; height: 154px;">
					</td>
				</tr>
			</table>
		</td>
		<td style="vertical-align: top;">
			<table align="left" cellspacing="0" cellpadding="0" style="vertical-align: top; text-align: center;">
				<tr>
					<td style="background-image: url('/img/melynaeilutevirsutine.jpg'); height: 23px;">
						<font style="font-weight: bold; font-family: tahoma; font-size: 11px; color: #defaff;">
							<?php echo strtoupper(__("Last matches", true)); ?></font>&nbsp;&nbsp;
					</td>
				</tr>
				<tr>
					<td style="background-color: #bee7f2; width: 204px; height: 131px; vertical-align: top;">
						<table align="left" cellspacing="0" cellpadding="0" style="vertical-align: top; text-align: left;" border="0">
						<tr>
							<td class="tarpelisdesinetext" style="height: 5px;">
								
							</td>
						</tr>
							<?php
							$i = 0;
							foreach ($matches as $match):
							$i++;
							?>
							<tr>
								<?php if (count($match['Result']) < 1): ?>
									<td class="tarpelisdesinetext" style="text-align:left;width:4%;">			
										&nbsp;&nbsp;
									</td>	
									<td class="tarpelisdesinetext" style="text-align:left;width:auto;">			
										<img src="/img/arr_pass.jpg">
									</td>					
									<td class="tarpelisdesinetext" style="text-align:left;width:34%;">			
										&nbsp;&nbsp;<?php echo $html->link(substr($match['Team1']['name'],0,10), array("controller" => "matches", "action" => "view", $match['Match']['id']));?>&nbsp;
									</td>
									<td class="tarpelisdesinetext"  style="text-align:center;width:20%;"> vs.
									</td>
									<td class="tarpelisdesinetext"  style="text-align:right;width:38%;">
										&nbsp;<?php echo $html->link(substr($match['Team2']['name'],0,10), array("controller" => "matches", "action" => "view", $match['Match']['id']));?>&nbsp;&nbsp;
									</td>
								<?php endif; ?>
								<?php if (count($match['Result']) > 0): ?>
									<td class="tarpelisdesinetext" style="text-align:left;width:4%;">			
										&nbsp;&nbsp;
									</td>	
									<td class="tarpelisdesinetext" style="text-align:left;width:auto;">			
										<img src="/img/arr_active.jpg">
									</td>										
									<td class="tarpelisdesinetext" style="text-align:left;width:34%;">			
										&nbsp;&nbsp;<?php echo $html->link(substr($match['Team1']['name'],0,10), array("controller" => "matches", "action" => "view", $match['Match']['id']));?>&nbsp;				
									</td>
									<td class="tarpelisdesinetext" style="text-align:center;width:20%;">
										<?php echo $html->link($match['Result'][0]['team1_score'], array("controller" => "matches", "action" => "view", $match['Match']['id']));?> : <?php echo  $html->link($match['Result'][0]['team2_score'], array("controller" => "matches", "action" => "view", $match['Match']['id']));?>
									</td>
									<td class="tarpelisdesinetext" style="text-align:right;width:38%;">
										&nbsp;<?php echo $html->link(substr($match['Team2']['name'],0,10), array("controller" => "matches", "action" => "view", $match['Match']['id']));?>&nbsp;&nbsp;		
									</td>
								<?php endif; ?>
								
										
							</tr>							
							<?php if ($i != count($matches)): ?><tr><td class="tarpelisdesine" colspan="5"></tr><?php endif; ?>
							<?php endforeach; ?>
						
						</table>
					</td>
			</table>
		</td>
		<td style="background-image: url('/img/desinyssonas.jpg'); width: 6px; height: 154px;">
		</td>
	</tr>
</table>