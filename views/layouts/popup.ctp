<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Edit</title>
<?php echo $html->charset(); echo $html->css('skygames'); ?>
<?php echo $javascript->link('popup'); ?>
</head>
<body>
<table align="center" cellspacing="0" cellpadding="0" width="600px"
	height="400px" style="vertical-align: top">
	<tr>
		<td style="vertical-align: top">
		<table align="center" cellspacing="0" cellpadding="0"
			style="vertical-align: top">
			<tr>
				<td class="baltabalta" style="vertical-align: top">
				<table align="left" cellspacing="0" cellpadding="0"
					style="width: 600px; height: 400px;"">
					<tr>
						<td style="vertical-align: top;">
						<table align="left" cellspacing="0" cellpadding="0"
							style="width: 600px; vertical-align: top; text-align: center;">
							<tr>
								<td
									style="width: 600px; height: 35px; vertical-align: middle; text-align: left;">
								&nbsp;&nbsp;&nbsp;<font
									style="font-family: tahoma; font-size: 11px; color: #616464;">
									<?php echo $title_for_content; ?> </font></td>
							</tr>
							<?php if ($session->check('Message.flash')):?>
							<tr>
								<td><?php $session->flash(); ?></td>
							</tr>
							<?php endif;?>

							<tr>
								<td style="width: 600px;">
								<table align="left" cellspacing="0" cellpadding="0"
									style="width: 600px; vertical-align: top; text-align: left;">
									<tr>
										<td
											style="width: 7px; background-image: url('/img/didelelentelekaire.jpg');">
										</td>
										<td style="width: <?php echo (600 - 14); ?>px;"><?php echo $content_for_layout;?>
										</td>
										<td
											style="width: 7px; background-image: url('/img/didelelenteledesine.jpg');">
										</td>
									</tr>
								</table>
								</td>
							</tr>
							<tr>
								<td style="width: 600px; height: 19px;"></td>
							</tr>
						</table>
						</td>
					</tr>
				</table>
				</td>
			</tr>
		</table>
		</td>
	</tr>
</table>

</body>
</html>
