<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SkyGames > <?php
	$k = __($this->name, true);
	echo $k;
	$r = strip_tags($title_for_content);
	$r = strstr($r, '::')?substr($r, 0, strpos($r, '::')):$r;
	if ($r != $k) {
	     echo ' > ';
	     echo $r;
	}	
	unset($r, $k);
	?></title>
<?php

echo $html->charset() . "\n";
echo $html->css('skygames') . "\n";
echo $scripts_for_layout . "\n";
?>
<?php //<link rel='icon' href=''>  ?>
</head>
<body>

<table align="center" cellspacing="0" cellpadding="0" class="mainonbg"
	style="vertical-align: top">
	<tr>
		<td
			style="width: 10px; height: 100%; vertical-align: top; background-image: url('/img/bgleft.jpg');">
		</td>

		<td class="main" style="vertical-align: top">


		<table align="center" cellspacing="0" cellpadding="0" class="main"
			style="vertical-align: top">
			<tr>
				<td class="zydra"></td>
				<td class="baltabalta" style="vertical-align: top">
				<table align="center" cellspacing="0" cellpadding="0" class="vatop">
					<tr>
						<td class="headbaneris"
							style="text-align: right; vertical-align: top">
							<ul class="languages_list">
								<li style="background-image: url('/img/flags/lt.png');">
									<?php echo $html->link(__('Lithuanian', true), '/lang/lit', null, null, false); ?>
								</li>
								<li style="background-image: url('/img/flags/us.png');">
									<?php echo $html->link(__('English', true), '/lang/eng', null, null, false); ?>
								</li>
							</ul>
						</td>
					</tr>
					<tr>
						<td class="meniubg">
						<?php echo $this->renderElement('menu', array('cache'=>'1 day'));?>
						</td>
					</tr>
					<tr>
						<td class="dupxheight"></td>
					</tr>
					<tr>
						<td class="devynivienasvienas">
						<table align="left" cellspacing="0" cellpadding="0"
							style="vertical-align: top;">
							<tr>
								<td style="width: 5px"></td>
								<td style="width: 700px; vertical-align: top;">
								<table align="left" cellspacing="0" cellpadding="0"
									style="width: 697px; vertical-align: top; text-align: center;">
									<tr>
										<td style="width: 700px; height: 160px;"><?php echo $this->renderElement('preview', array('cache'=>'1 hour'));?>
										</td>
									</tr>
									<tr>
										<td style="height: 2px;"><?php //<cake:nocache> ?>
										<?php
										if ($session->check('Message.flash')):
										$session->flash();
										endif;
										?>
										<?php //</cake:nocache> ?></td>
									</tr>
									<tr>
										<td
											style="width: 697px; vertical-align: top; text-align: center;">
											<?php if (!$content_full_fill): ?> <?php
											if (!$content_helpers) $size = '697';
											else $size = '481';
											?>
										<table align="left" cellspacing="0" cellpadding="0"
											style="width: 697px;">
											<tr>
												<td style="vertical-align: top;">
												<?php if (substr($this->action, 0, 5)!='admin') : ?>
												<table align="left" cellspacing="0" cellpadding="0" style="width: <?php echo $size;?>px; vertical-align: top;
			                                                        text-align: center;">
													<tr>
														<td style="background-image: url('/img/didelelentelevirsus<?php echo $size;?>.jpg'); width: <?php echo $size;?>; height: 35px;
			                                                                vertical-align: middle; text-align: left;">
														&nbsp;&nbsp;&nbsp;<span
															style="font-family: tahoma; font-size: 11px; color: #616464;">
															<?php echo $title_for_content; ?> </span></td>
													</tr>

													<tr>
														<td style="width: <?php echo $size;?>px;">
														<table align="left" cellspacing="0" cellpadding="0" style="width: <?php echo $size;?>px; vertical-align: top;
			                                                                    text-align: left;">
															<tr>
																<td
																	style="width: 7px; background-image: url('/img/didelelentelekaire.jpg');">
																</td>
																<td style="width: <?php echo ($size - 14);?>px;"><?php echo $content_for_layout;?>
																</td>
																<td
																	style="width: 7px; background-image: url('/img/didelelenteledesine.jpg');">
																</td>
															</tr>
														</table>
														</td>
													</tr>
													<tr>
														<td style="background-image: url('/img/didelelenteleapacia<?php echo $size;?>.jpg'); width: <?php echo $size;?>px; height: 19px;">
														</td>
													</tr>
												</table>
												<?php else: ?>
													<div class="admin_area_in_main_page">
														<?php														
														echo $content_for_layout;
														?>
													</div>
												<?php endif; ?>
												</td>

												<td style="vertical-align: top;">
												<?php 
												if (!empty($content_helpers) && substr($this->action, 0, 5)!='admin'):?>
												<table cellspacing="0" cellpadding="0">
																								
												<?php foreach($content_helpers as $helper): ?>
													<tr>
														<td>
														<?php if (isset($helper['cachetime']) && $helper['cachetime'])
														echo $this->renderElement($helper['name'], $helper['cachetime']);
														else
														echo $this->renderElement($helper['name'], array('cache' => '1 hour'));
														?>
														</td>
													</tr>
													<?php endforeach; ?>													
												
												</table>
												<?php endif; ?>
												</td>
											</tr>
										</table>
										<?php else: ?> <?php echo $content_for_layout;?> <?php endif;?>
										</td>
									</tr>
									<tr>
										<td style="height: 7px;"></td>
									</tr>
								</table>
								</td>
								<td
									style="width: 201px; vertical-align: top; text-align: center;">
								<table align="left" cellspacing="0" cellpadding="0"
									style="width: 201px; vertical-align: top;">
									<tr>
										<td
											style="width: 195px; height: 160px; text-align: left; vertical-align: top;">
										<table align="left" cellspacing="0" cellpadding="0"
											style="width: 195px; vertical-align: top;">
											<tr>
												<td
													style="background-image: url('/img/mazalentelevirsus.jpg'); width: 195px; height: 35px; vertical-align: middle; text-align: center;">
												<font
													style="font-weight: bold; font-family: tahoma; font-size: 11px; color: #616464;">
													<?php echo strtoupper(__("For users")); ?></font></td>
											</tr>
											<tr>
												<td style="width: 195px; vertical-align: top;">
												<table align="left" cellspacing="0" cellpadding="0"
													style="width: 195px; height: 112px; vertical-align: top;">
													<tr>
														<td
															style="width: 7px; background-image: url('/img/didelelentelekaire.jpg');">
														</td>
														<td style="width: 181px; vertical-align: top;">
														<?php //<cake:nocache> ?>
														<?php $uid = $othAuth->user('id'); ?>
														<?php echo $this->renderElement('loginbox', array('cache'=>'+1 hour', 'plugin' => (isset($uid) ? $uid : '0')));?>
														<?php //</cake:nocache> ?>
														</td>
														<td
															style="width: 7px; background-image: url('/img/didelelenteledesine.jpg');">
														</td>

													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td
													style="background-image: url('/img/mazalenteleapacia.jpg'); width: 195px; height: 13px; vertical-align: middle; text-align: left;">
												</td>
											</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td>
											<table align="left" cellspacing="0" cellpadding="0"
											style="width: 195px; vertical-align: top;">
											<tr>
												<td
													style="background-image: url('/img/mazalentelevirsus.jpg'); width: 195px; height: 35px; vertical-align: middle; text-align: center;">
												<font
													style="font-weight: bold; font-family: tahoma; font-size: 11px; color: #616464;">
													<?php echo strtoupper(__("Advertisement")); ?></font></td>
											</tr>
											<tr>
												<td style="width: 195px; vertical-align: top;">
												<table align="left" cellspacing="0" cellpadding="0"
													style="width: 195px; vertical-align: top;">
													<tr>
														<td
															style="width: 7px; background-image: url('/img/didelelentelekaire.jpg');">
														</td>
														<td style="width: 181px; vertical-align: top;">
															<?php echo $this->renderElement('advertisements_right', array('cache'=>'+1 hour'));?>
														</td>
														<td
															style="width: 7px; background-image: url('/img/didelelenteledesine.jpg');">
														</td>

													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td
													style="background-image: url('/img/mazalenteleapacia.jpg'); width: 195px; height: 13px; vertical-align: middle; text-align: left;">
												</td>
											</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td>
											<table align="left" cellspacing="0" cellpadding="0"
											style="width: 195px; vertical-align: top;">
											<tr>
												<td
													style="background-image: url('/img/mazalentelevirsus.jpg'); width: 195px; height: 35px; vertical-align: middle; text-align: center;">
												<font
													style="font-weight: bold; font-family: tahoma; font-size: 11px; color: #616464;">
													<?php echo strtoupper(__("We in Social Networks")); ?></font></td>
											</tr>
											<tr>
												<td style="width: 195px; vertical-align: top;">
												<table align="left" cellspacing="0" cellpadding="0"
													style="width: 195px; vertical-align: top;">
													<tr>
														<td
															style="width: 7px; background-image: url('/img/didelelentelekaire.jpg');">
														</td>
														<td style="width: 181px; vertical-align: top;">
															<?php echo $this->renderElement('social_networks', array('cache'=>'+24 hour'));?>
														</td>
														<td
															style="width: 7px; background-image: url('/img/didelelenteledesine.jpg');">
														</td>

													</tr>
												</table>
												</td>
											</tr>
											<tr>
												<td
													style="background-image: url('/img/mazalenteleapacia.jpg'); width: 195px; height: 13px; vertical-align: middle; text-align: left;">
												</td>
											</tr>
										</table>
										</td>
									</tr>
								</table>
								</td>
								<td style="width: 5px"></td>
							</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td style="height: 20px; width: 911px;"></td>
					</tr>
					<tr>
						<td style="height: 7px; width: 911px; background-color: #a5c3d1;">
						</td>
					</tr>
					<tr>
						<td
							style="height: 77px; width: 911px; text-align: center; vertical-align: middle;">
							<?php __('copyright'); ?></td>
					</tr>
				</table>
				</td>
				<td style="width: 7px; height: 100%; background-color: #a5c3d1;"></td>
			</tr>
		</table>

		</td>
		<td
			style="width: 10px; height: 100%; background-image: url('/img/bgright.jpg');">
		</td>
	</tr>
</table>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-271854-3");
pageTracker._initData();
pageTracker._trackPageview();

</script>
</body>
</html>
