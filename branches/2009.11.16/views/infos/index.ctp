
<?php
if (!$content_helpers) $size = '697';
else $size = '481';
?>

<table align="left" cellspacing="0" cellpadding="0" style="width: 697px;">
	<tr>
		<td style="vertical-align: top; width:<?php echo $size;?>px;">
		
		<table cellspacing="0" cellpadding="0" align="left" style="width: <?php echo $size;?>px; vertical-align: top; text-align: center;">
		<?php
		$i = 0;
		foreach ($infos as $info):

		?>
			<tr>
				<td style="width: <?php echo $size;?>px">
				<table align="left" cellspacing="0" cellpadding="0" style="width: <?php echo $size;?>px; vertical-align: top;text-align: center;">
					<tr>
						<td style="background-image: url('/img/didelelentelevirsus<?php echo $size;?>.jpg'); width: <?php echo $size;?>px; height: 35px;
                                                                vertical-align: middle; text-align: left;">
						&nbsp;&nbsp;&nbsp;<font
							style="font-family: tahoma; font-size: 11px; color: #616464;"> <b><?php echo $info['Info']['title']; ?></b>
						:: <?php echo $info['Info']['created']; ?></font></td>
					</tr>

					<tr>
						<td style="width: <?php echo $size;?>px;">
						<table align="left" cellspacing="0" cellpadding="0" style="width: <?php echo $size;?>px; vertical-align: top;
                                                                    text-align: left;">
							<tr>
								<td
									style="width: 7px; background-image: url('/img/didelelentelekaire.jpg');">
								</td>
								<td style="width: <?php echo ($size - 14);?>px;" class="list">
								
									<table border="0">
										<tr>
											<td colspan="2"><div class="view"><?php echo $info['Info']['desc']; ?></div></td>
										</tr>
										<tr>
											<td style='width: 100%'></td>
											<td style='text-align: right; width: 1%'><br />
											<table class='altrow' style="height: 16px;" cellpadding="0"
												cellspacing="0">
												<tr>
													<td>
													<table cellspacing="0" cellpadding="0"
														style='text-align: right; background: #e7e7e7;'>
														<tr>
															<td style="vertical-align: middle;"><?php echo $html->image('/img/infos/view.png') ?>
															</td>
															<td style="vertical-align: middle;"><?php echo $html->link(__('Read', true), '/info/' . $info['Info']['id'] . ':' . slug($info['Info']['title'])); ?>
	
															</td>
														</tr>
													</table>
													</td>
													<td>
													<table cellspacing="0" cellpadding="0"
														style='text-align: right; background: #e7e7e7;'>
														<tr>
															<td style="vertical-align: middle;"><?php echo $html->image('/img/orgs/member.png') ?>
															</td>
															<td style="vertical-align: middle;"><?php echo $html->link( $info['User']['username'], array('controller'=>'users','action'=>'view',  $info['User']['id'])); ?>
															</td>
														</tr>
													</table>
													</td>
													<td>
													<table cellspacing="0" cellpadding="0"
														style='text-align: right; background: #e7e7e7;'>
														<tr>
															<td style="vertical-align: middle;"><?php echo $html->image('/img/infos/comments.png') ?>
															</td>
															<td style="vertical-align: middle;"><?php __('Comments');?>:<?php echo count($info['Infocomment']); ?>
															</td>
														</tr>
													</table>
													</td>
												</tr>
											</table>
											
											
											</td>
										
										</tr>
									</table>

								
								</td>
								<td style="width: 7px; background-image: url('/img/didelelenteledesine.jpg');">

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
				</td>
			</tr>
			<?php endforeach; ?>
			<tr>
				<td>
					<div class="paging"><?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
						| <?php echo $paginator->numbers();?> <?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
					</div>
				</td>
			</tr>
		</table>
		</td>

		<td style="vertical-align: top;">
		<table cellspacing="0" cellpadding="0">

		<?php if (!empty($content_helpers)):?>
		<?php foreach($content_helpers as $helper): ?>
			<tr>
				<td><?php if (isset($helper['cachetime']) && $helper['cachetime']) 
				echo $this->renderElement($helper['name'], $helper['cachetime']);
				else
				echo $this->renderElement($helper['name'], array('cache' => '1 hour'));
				?></td>
			</tr>
			<?php endforeach; ?>
			<?php endif; ?>

		</table>

		</td>
	</tr>
</table>



