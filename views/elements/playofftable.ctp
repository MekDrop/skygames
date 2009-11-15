
	
	<style type="text/css">
		@import url("/css/tablo/<?php echo $playofftable['Playofftable']['theme']; ?>.css");
	</style>
	
	<div class="background">
	
	<div align="center" class="background">	
		<?php //if (!empty($playofftable['Match'])):?>
		<table cellpadding = "0" cellspacing = "0" border="0" width="auto">
			<tr>
				<?php for ($i = 1;$i <= log($playofftable['Playofftable']['size'], 2); $i++):?>
				<td>
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<th class="tableheader"><?php __('Playoff round'); ?>&nbsp;<?php echo $i; ?></th><th class="narrowvoidcell"></th>
						</tr>	
					</table>
				</td>				
				<?php endfor;?>
				<?php if ($playofftable['Playofftable']['type'] == 'S' && $playofftable['Playofftable']['size'] < 64): ?>					
				<td>
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<th class="tableheader"><?php __('Winner'); ?></th>
						</tr>	
					</table>
				</td>	
				<?php endif; ?>			
			</tr>
			
			
			
			<tr>
				<?php for ($i = 1;$i <= log($playofftable['Playofftable']['size'], 2); $i++):?>
				<td>
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<td class="voidcellfull">&nbsp;</td><td class="narrowvoidcell"></td>
						</tr>	
					</table>
				</td>				
				<?php endfor;?>
				<?php if ($playofftable['Playofftable']['type'] == 'S' && $playofftable['Playofftable']['size'] < 64): ?>					
				<td>
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<td class="voidcellfull">&nbsp;</td>
						</tr>	
					</table>
				</td>	
				<?php endif; ?>	
			</tr>
			
			
			
			<?php $drawLine = array(); ?>
			<?php $drawLine = array_fill(0, log($playofftable['Playofftable']['size'], 2) + 1, false); ?>		
				
			<?php for ($y = 1;$y <= $playofftable['Playofftable']['size'] - 1; $y++):?>
			<tr>
			<?php for ($x = 1;$x <= log($playofftable['Playofftable']['size'], 2); $x++):		
				$match = null;											
				foreach ($pmatches as $searchMatch)
					if ($searchMatch['Match']['tposition_x'] == $x && ((pow(2, $x) * $searchMatch['Match']['tposition_y'] - pow(2, $x - 1)) == $y - pow(2, $x - 2) ||
					(pow(2, $x) * $searchMatch['Match']['tposition_y'] - pow(2, $x - 1)) == $y + pow(2, $x - 2) ||
					(pow(2, $x) * $searchMatch['Match']['tposition_y'] - pow(2, $x - 1)) == $y
					) && is_null($match))
						$match = $searchMatch;		
			?>
				<td align="center" >
					<?php if (!empty($match)):?>
					
						<?php if ($x > 1): ?>
							<table cellpadding = "0" cellspacing = "0" border="0" width="100%">							
								<tr>				
									<td class="voidcellfull">
										
									</td>	
									<?php if ((pow(2, $x) * $match['Match']['tposition_y'] - pow(2, $x - 1)) == $y - pow(2, $x - 2) || (pow(2, $x) * $match['Match']['tposition_y'] - pow(2, $x - 1)) == $y):?>
									<td class="lvlinecell">
										
									</td>	
									<?php else: ?>
									<td class="narrowvoidcell">
										
									</td>									
									<?php endif; ?>																			
								</tr>															
								<tr>									
									<?php if ((pow(2, $x) * $match['Match']['tposition_y'] - pow(2, $x - 1)) == $y):?>
											
										<td class="voidcellfull" style="text-align:center">									
											<?php if (count($match['Result']) > 0): ?>	
												<?php echo $match['Result'][0]['team1_score']; ?><?php echo " : "; ?><?php echo $match['Result'][0]['team2_score'];?>
											<?php endif; ?>
										</td>		
										<td class="lcentercell">										
											
										</td>																													
									<?php endif; ?>																		
									<?php if ((pow(2, $x) * $match['Match']['tposition_y'] - pow(2, $x - 1)) == $y - pow(2, $x - 2)):?>
										
										<td class="playercell">
											<?php echo $match['Team2']['tag'];?>
										</td>																			
										<td class="brcornercell">
											
										</td>																			
									<?php $drawLine[$x] = false; ?>													
																			
									<?php endif; ?>
									<?php if ((pow(2, $x) * $match['Match']['tposition_y'] - pow(2, $x - 1)) == $y + pow(2, $x - 2)):?>
																													
										<td class="playercell">							
											<?php echo $match['Team1']['tag'];?>
										</td>
										<td class="trcornercell">
											
										</td>																			
									<?php $drawLine[$x] = true; ?>
																				
									<?php endif; ?>										
								</tr>							
								<tr>																																								
									<td class="voidcellfull">
									
									</td>		
									<?php if ((pow(2, $x) * $match['Match']['tposition_y'] - pow(2, $x - 1)) == $y + pow(2, $x - 2) || (pow(2, $x) * $match['Match']['tposition_y'] - pow(2, $x - 1)) == $y):?>
										<td class="lvlinecell">
											
										</td>	
									<?php else: ?>
									<td class="narrowvoidcell">
										
									</td>									
										
									<?php endif; ?>																												
								</tr>								
							</table>					
						<?php else: ?>
							<table cellpadding = "0" cellspacing = "0" border="0" width="100%">		
								<tr>																			
									<td class="playercell">							
										<?php echo $match['Team1']['tag'];?>
									</td>		
									<td class="trcornercell">
										
									</td>																									
								</tr>														
								<tr>																						
									<td class="voidcellfull" style="text-align:center">									
										<?php if (count($match['Result']) > 0): ?>	
											<?php echo $match['Result'][0]['team1_score']; ?><?php echo " : "; ?><?php echo $match['Result'][0]['team2_score'];?>
										<?php endif; ?>
									</td>	
									<td class="lcentercell">
									
									</td>																				
								</tr>																				
								<tr>																							
									<td class="playercell">
										<?php echo $match['Team2']['tag'];?>
									</td>		
									<td class="brcornercell">
										
									</td>
								</tr>								
							</table>
						<?php endif; ?>
											
					<?php else: ?>
						<?php if ( fmod($y-pow(2, $x - 1), pow(2, $x)) == 0 || fmod($y - pow(2, $x - 2) - pow(2, $x - 1), pow(2, $x)) == 0 || fmod($y + pow(2, $x - 2) - pow(2, $x - 1), pow(2, $x)) == 0): ?>
						
							<?php if ($x > 1): ?>
								<table cellpadding = "0" cellspacing = "0" border="0" width="100%">							
									<tr>																			
										<td class="voidcellfull">
											
										</td>	
										<?php if (fmod($y - pow(2, $x - 2) - pow(2, $x - 1), pow(2, $x)) == 0 || fmod($y-pow(2, $x - 1), pow(2, $x)) == 0):?>									
										<td class="lvlinecell">
											
										</td>	
										<?php else: ?>
										<td class="narrowvoidcell">
											
										</td>									
										
										<?php endif; ?>																					
									</tr>															
									<tr>									
										<?php if (fmod($y-pow(2, $x - 1), pow(2, $x)) == 0):?>
											<td class="voidcellfull" style="text-align:center" width="100%">
												
											</td>	
											<td class="lcentercell">
											
											</td>																																														
										<?php endif; ?>																		
										<?php if (fmod($y - pow(2, $x - 2) - pow(2, $x - 1), pow(2, $x)) == 0):?>
											
											<td class="playercell">
												&nbsp;&nbsp;---&nbsp;&nbsp;
											</td>																			
											<td class="brcornercell">
												
											</td>		
										<?php $drawLine[$x] = false; ?>		
										<?php endif; ?>
										<?php if (fmod($y + pow(2, $x - 2) - pow(2, $x - 1), pow(2, $x)) == 0):?>
																													
											<td class="playercell">							
												&nbsp;&nbsp;---&nbsp;&nbsp;
											</td>
											<td class="trcornercell">
												
											</td>																			
										<?php $drawLine[$x] = true; ?>
										<?php endif; ?>										
									</tr>							
									<tr>																																								
										<td class="voidcellfull">
											
										</td>	
										<?php if (fmod($y + pow(2, $x - 2) - pow(2, $x - 1), pow(2, $x)) == 0 || fmod($y-pow(2, $x - 1), pow(2, $x)) == 0):?>										
										<td class="lvlinecell">
											
										</td>	
										<?php else: ?>
										<td class="narrowvoidcell">
											
										</td>									
										<?php endif; ?>																			
									</tr>								
								</table>
							<?php else: ?>
								<table cellpadding = "0" cellspacing = "0" border="0" width="100%">		
								<tr>																			
									<td class="playercell">							
										&nbsp;&nbsp;---&nbsp;&nbsp;
									</td>		
									<td class="trcornercell">
										
									</td>																									
								</tr>														
								<tr>																						
									<td class="voidcellfull" style="text-align:center">									
										
									</td>	
									<td class="lcentercell">
										
									</td>																				
								</tr>																				
								<tr>																							
									<td class="playercell">
										&nbsp;&nbsp;---&nbsp;&nbsp;
									</td>		
									<td class="brcornercell">
										
									</td>
								</tr>								
							</table>
							<?php endif; ?>		
						<?php else: ?>		
							<?php if ($drawLine[$x]): ?>
							<table cellpadding = "0" cellspacing = "0" width="100%">	
								<tr>				
									<td class="voidcellfull">
										
									</td>
									<td class="lvlinecell">
										
									</td>																						
								</tr>	
								<tr>
									<td class="voidcellfull">
										
									</td>
									<td class="lvlinecell">
										
									</td>																						
								</tr>	
								<tr>
									<td class="voidcellfull">
									
									</td>																					
									<td class="lvlinecell">
										
									</td>																						
								</tr>									
							</table>
							<?php else: ?>	
							<table cellpadding = "0" cellspacing = "0" width="100%">	
								<tr>		
									<td class="voidcellfull">
									
									</td>																			
									<td class="narrowvoidcell">
										
									</td>	
																								
								</tr>	
								<tr>		
								   <td class="voidcellfull">
										
									</td>																					
									<td class="narrowvoidcell">
										
									</td>	
																														
								</tr>	
								<tr>	
								   <td class="voidcellfull">
									
									</td>																						
									<td class="narrowvoidcell">
										
									</td>																						
								</tr>								
							</table>
							<?php endif; ?>	
						<?php endif; ?>	

					<?php endif; ?>													
				</td>
				<!-- 
					Finalas Single Elimination
				 -->
				<?php if ($x == log($playofftable['Playofftable']['size'], 2) && $playofftable['Playofftable']['type'] == 'S' && $playofftable['Playofftable']['size'] < 64): ?>					
				<td>
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">		
						<tr>																			
							<td class="voidcellfull">							
								
							</td>		
																																
						</tr>														
						<tr>																
							<?php if (fmod($y-pow(2, $x - 1), pow(2, $x)) == 0):?>						
							<td class="playercell" style="text-align:center">									
								<?php if (count($match['Result']) > 0): ?>
									<?php if ($match['Result'][0]['team2_score'] > $match['Result'][0]['team1_score']): ?>
										<?php echo $match['Team2']['tag'];?>
									<?php else: ?>
										<?php echo $match['Team1']['tag']; ?>
									<?php endif; ?>
								<?php endif; ?>
							</td>
							<?php else: ?>
							<td class="voidcellfull" style="text-align:center">	
								
							</td>
							<?php endif; ?>	
																										
						</tr>																				
						<tr>																							
							<td class="voidcellfull">
								
							</td>		
							
						</tr>								
					</table>
				</td>
				<?php endif; ?>				
			<?php endfor;?>
			</tr>
		<?php endfor;?>
		</table>
		<?php //endif; ?>
	</div>
	
	<!-- 
		Finalas Double Elimination
	 -->
	<br/>
	
	<?php if ($playofftable['Playofftable']['type'] == 'D'):?>
	
	<?php 	
		$match = null;			
		foreach ($pmatches as $searchMatch)
		if (($searchMatch['Match']['tposition_x'] == 0 && $searchMatch['Match']['tposition_y']  == 0) && is_null($match))
			$match = $searchMatch;		
		?>		
	
	<div align="center" class="background">
		<table cellpadding = "0" cellspacing = "0">
			<tr>				
				<td >
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<td class="voidcellfullbackground">&nbsp;</td>
						</tr>	
					</table>
				</td>		
				<td>
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<td class="narrowvoidcell"></td><th class="tableheader"><?php __('Final'); ?></th><th class="narrowvoidcell"></th>
						</tr>	
					</table>
				</td>
				<td>
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<th class="tableheader"><?php __('Winner'); ?></th><th class="narrowvoidcell"></th>
						</tr>	
					</table>
				</td>
				<td >
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<td class="voidcellfullbackground">&nbsp;</td><td class="narrowvoidcell">&nbsp;</td>
						</tr>	
					</table>
				</td>	
			</tr>
			<tr>		
				<td >
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<td class="voidcellfullbackground">&nbsp;</td>
						</tr>	
					</table>
				</td>			
				<td>
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<td class="narrowvoidcell"></td><td class="voidcellfull">&nbsp;</td><td class="narrowvoidcell"></td>
						</tr>	
					</table>
				</td>	
				<td>
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<td class="voidcellfull">&nbsp;</td><td class="narrowvoidcell"></td>
						</tr>	
					</table>
				</td>	
				<td >
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<td class="voidcellfullbackground"></td><td class="narrowvoidcell">&nbsp;</td>
						</tr>	
					</table>
				</td>					
			</tr>	
			<tr>		
				<td >
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%"  height="37">
						<tr>
							<td class="voidcellfullbackground">&nbsp;</td>
						</tr>	
					</table>
				</td>					
				<td>
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%"  height="37">
						<tr>
							<td class="narrowvoidcell"></td><td class="voidcellfull">&nbsp;</td><td class="narrowvoidcell"></td>
						</tr>	
					</table>
				</td>	
				<td>
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%" height="37">
						<tr>
							<?php if (count($match['Result']) > 0): ?>	
							<td class="bigvlinecell">								
							</td>
							<?php else: ?>
							<td class="voidcellfull">								
							</td>							
							<?php endif; ?>
							<td class="narrowvoidcell"></td>
						</tr>	
					</table>
				</td>	
				<td >
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%"  height="37">
						<tr>
							<td class="voidcellfullbackground"></td><td class="narrowvoidcell">&nbsp;</td>
						</tr>	
					</table>
				</td>					
			</tr>			
			<tr>		
				<td >
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<td class="voidcellfullbackground">&nbsp;</td>
						</tr>
						<tr>
							<td class="voidcellfullbackground">&nbsp;</td>
						</tr>
						<tr>
							<td class="voidcellfullbackground">&nbsp;</td>
						</tr>
					</table>
				</td>	
				
				<td align="center">
				
				<?php if (!empty($match)):?>
				
				
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">		
						<tr>				
							<td class="narrowvoidcell"></td>																						
							<td class="playercell">							
								&nbsp;&nbsp;<?php echo $match['Team1']['tag'];?>&nbsp;&nbsp;
							</td>		
							<td class="trcornercell">
								
							</td>																									
						</tr>														
						<tr>		
							<td class="narrowvoidcell"></td>																				
							<td class="voidcellfull" style="text-align:center">									
								<?php if (count($match['Result']) > 0): ?>	
									<?php echo $match['Result'][0]['team1_score']; ?><?php echo " : "; ?><?php echo $match['Result'][0]['team2_score'];?>
								<?php endif; ?>
							</td>	
							<td class="lcentercell">
							
							</td>																				
						</tr>																				
						<tr>		
							<td class="narrowvoidcell"></td>																					
							<td class="playercell">
								&nbsp;&nbsp;<?php echo $match['Team2']['tag'];?>&nbsp;&nbsp;
							</td>		
							<td class="brcornercell">
								
							</td>
						</tr>								
					</table>	
					
					
				<?php else: ?>
					
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">		
						<tr>					
							<td class="narrowvoidcell"></td>														
							<td class="playercell">							
								&nbsp;&nbsp;---&nbsp;&nbsp;
							</td>		
							<td class="trcornercell">
								
							</td>																									
						</tr>														
						<tr>		
							<td class="narrowvoidcell"></td>																				
							<td class="voidcellfull" style="text-align:center">									
								
							</td>	
							<td class="lcentercell">
								
							</td>																				
						</tr>																				
						<tr>		
							<td class="narrowvoidcell"></td>																					
							<td class="playercell">
								&nbsp;&nbsp;---&nbsp;&nbsp;
							</td>		
							<td class="brcornercell">
								
							</td>
						</tr>								
					</table>
					
				<?php endif; ?>													
									
				</td>
				
			
				<td align="center">
					<?php if (!empty($match)):?>
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">		
						<tr>																			
							<td class="voidcellfull">							
								
							</td>		
							<td class="narrowvoidcell">
								
							</td>																									
						</tr>														
						<tr>																						
							<td class="playercell" style="text-align:center">									
								<?php if (count($match['Result']) > 0): ?>
									<?php if ($match['Result'][0]['team2_score'] > $match['Result'][0]['team1_score']): ?>
										&nbsp;&nbsp;<?php echo $match['Team2']['tag'];?>&nbsp;&nbsp;
									<?php else: ?>
										&nbsp;&nbsp;<?php echo $match['Team1']['tag']; ?>&nbsp;&nbsp;
									<?php endif; ?>
								<?php endif; ?>
							</td>	
							<td class="narrowvoidcell">
							
							</td>																				
						</tr>																				
						<tr>																							
							<td class="voidcellfull">
								
							</td>		
							<td class="narrowvoidcell">
								
							</td>
						</tr>								
					</table>	
					
					
				<?php else: ?>
					
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">		
						<tr>																			
							<td class="voidcellfull">							
								
							</td>		
							<td class="narrowvoidcell">
								
							</td>																									
						</tr>														
						<tr>																						
							<td class="playercell" style="text-align:center">									
								&nbsp;&nbsp;---&nbsp;&nbsp;
							</td>	
							<td class="narrowvoidcell">
								
							</td>																				
						</tr>																				
						<tr>																							
							<td class="voidcellfull">
								
							</td>		
							<td class="narrowvoidcell">
								
							</td>
						</tr>								
					</table>
					
				<?php endif; ?>													
									
				</td>
				<td >
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<td class="voidcellfullbackground"></td><td class="narrowvoidcell">&nbsp;</td>
						</tr>
						<tr>
							<td class="voidcellfullbackground"></td><td class="narrowvoidcell">&nbsp;</td>
						</tr>	
						<tr>
							<td class="voidcellfullbackground"></td><td class="narrowvoidcell">&nbsp;</td>
						</tr>		
					</table>
				</td>	
				
			</tr>
			
			<tr>		
				<td  >
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<td class="voidcellfullbackground">&nbsp;</td>
						</tr>	
					</table>
				</td>		
				<td>
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<td class="narrowvoidcell"></td><td class="voidcellfull"></td><td class="narrowvoidcell"></td>
						</tr>	
					</table>
				</td>				
				<td>
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<td class="voidcellfull"></td><td class="narrowvoidcell"></td>
						</tr>	
					</table>
				</td>		
				<td >
					<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
						<tr>
							<td class="voidcellfullbackground"></td><td class="narrowvoidcell">&nbsp;</td>
						</tr>	
					</table>
				</td>	
			</tr>				
		</table>
		
		
	</div>
	
	<br/>
	
	<!-- 
		Looser rounds for double elimination
	 -->
	
	
	<div align="center" class="background">	
	<?php //if (!empty($playofftable['Match'])):?>
		<table cellpadding = "0" cellspacing = "0" border="0" width="auto">		
		<tr>
		<?php for ($i = 1;$i <= log($playofftable['Playofftable']['size'] / 2, 2) * 2; $i++):?>				
			<td>
				<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
					<tr>
						<th class="tableheader"><?php __('Playoff round'); ?>&nbsp;<?php echo $i; ?></th><th class="narrowvoidcell"></th>
					</tr>	
				</table>
			</td>
		<?php endfor;?>
		</tr>
		
		<tr>
		<?php for ($i = 1;$i <= log($playofftable['Playofftable']['size'] / 2, 2) * 2; $i++):?>
			<td>
				<table cellpadding = "0" cellspacing = "0" border="0" width="100%">
					<tr>
						<td class="voidcellfull">&nbsp;</td><td class="narrowvoidcell"></td>
					</tr>	
				</table>
			</td>				
		<?php endfor;?>
		</tr>
		
		<?php $drawLine = array(); ?>
		<?php $drawLine = array_fill(0, log($playofftable['Playofftable']['size'] / 2 , 2) + 1, false); ?>	
					
		<?php for ($y = 1;$y <= $playofftable['Playofftable']['size'] / 2 - 1; $y++):?>
		<tr>
			
			<?php for ($x = 1;$x <= log($playofftable['Playofftable']['size'] / 2, 2); $x = $x + 1):					
				if ($x == 1) $x2 = 1;
				else $x2 = $x * 2 - 1;
				$match = null;
				foreach ($pmatches as $searchMatch)
					if ($searchMatch['Match']['tposition_x'] * (-1) == $x2 && (
					(pow(2, $x) * $searchMatch['Match']['tposition_y'] - pow(2, $x - 1)) == $y ||
					(pow(2, $x) * $searchMatch['Match']['tposition_y'] - pow(2, $x - 1)) == $y - pow(2, $x - 2) ||
					(pow(2, $x) * $searchMatch['Match']['tposition_y'] - pow(2, $x - 1)) == $y + pow(2, $x - 2)
					) 
					
					&& is_null($match))
						$match = $searchMatch;		
			?>
			<td align="center">
			
				<?php if (!empty($match)):?>
					
						<?php if ($x > 1): ?>
							<table cellpadding = "0" cellspacing = "0" border="0" width="100%">							
								<tr>				
									<td class="voidcellfull">
										
									</td>	
									<?php if ((pow(2, $x) * $match['Match']['tposition_y'] - pow(2, $x - 1)) == $y):?>
									<td class="lcentercell">
										
									</td>	
									<?php elseif((pow(2, $x) * $match['Match']['tposition_y'] - pow(2, $x - 1)) == $y - pow(2, $x - 2)): ?>
									<td class="lvlinecell">
										
									</td>
									<?php else: ?>	
									<td class="narrowvoidcell">
										
									</td>									
									<?php endif; ?>																			
								</tr>					
																	
								<tr>								
									<?php if ((pow(2, $x) * $match['Match']['tposition_y'] - pow(2, $x - 1)) == $y + pow(2, $x - 2)):?>
																													
										<td class="playercell">							
											&nbsp;&nbsp;<?php echo $match['Team1']['tag'];?>&nbsp;&nbsp;
										</td>
										
										<td class="trcornercell">							
											
										</td>																																							
									<?php $drawLine[$x] = true; ?>																				
									<?php endif; ?>						
													
									<?php if ((pow(2, $x) * $match['Match']['tposition_y'] - pow(2, $x - 1)) == $y):?>
											
										<td class="voidcellfull" style="text-align:center">									
											<?php if (count($match['Result']) > 0): ?>													
												<?php echo $match['Result'][0]['team1_score']; ?><?php echo " : "; ?><?php echo $match['Result'][0]['team2_score'];?>																																			
											<?php endif; ?>
										</td>		
										<td class="lvlinecell">										
											
										</td>																																							
									<?php endif; ?>
																											
									<?php if ((pow(2, $x) * $match['Match']['tposition_y'] - pow(2, $x - 1)) == $y - pow(2, $x - 2)):?>
										
										<td class="playercell">
											&nbsp;&nbsp;<?php echo $match['Team2']['tag'];?>&nbsp;&nbsp;
										</td>																			
										
										<td class="brcornercell">							
											
										</td>																											
									<?php $drawLine[$x] = false; ?>																																
									<?php endif; ?>
										
								</tr>							
								<tr>																																								
									<td class="voidcellfull">
									
									</td>		
									<?php if ((pow(2, $x) * $match['Match']['tposition_y'] - pow(2, $x - 1)) == $y + pow(2, $x - 2) || (pow(2, $x) * $match['Match']['tposition_y'] - pow(2, $x - 1)) == $y):?>
										<td class="lvlinecell">
											
										</td>	
									<?php else: ?>
									<td class="narrowvoidcell">
										
									</td>									
										
									<?php endif; ?>																												
								</tr>								
							</table>					
						<?php else: ?>
							<table cellpadding = "0" cellspacing = "0" border="0" width="100%">							
								<tr>																			
									<td class="playercell">
										&nbsp;&nbsp;<?php echo $match['Team1']['tag'];?>&nbsp;&nbsp;
									</td>		
									<?php if( $match['Result'][0]['team2_score'] > $match['Result'][0]['team1_score']): ?>
									<td class="tlcornercell">							
										
									</td>		
									<?php else: ?>
									<td class="hlinecell">							
										
									</td>								
									<?php endif; ?>
								</tr>															
								<tr>									
						
									<td class="voidcellfull">									
										<?php if (count($match['Result']) > 0): ?>	
											<?php echo $match['Result'][0]['team1_score']; ?><?php echo " : "; ?><?php echo $match['Result'][0]['team2_score'];?>
										<?php endif; ?>
									</td>		
									<?php if( $match['Result'][0]['team2_score'] > $match['Result'][0]['team1_score']): ?>
									<td class="lvlinecell">							
										
									</td>		
									<?php else: ?>
									<td class="narrowvoidcell">							
										
									</td>								
									<?php endif; ?>
								</tr>							
								<tr>																																								
									<td class="playercell">							
										&nbsp;&nbsp;<?php echo $match['Team2']['tag'];?>&nbsp;&nbsp;
									</td>	
									<?php if( $match['Result'][0]['team2_score'] > $match['Result'][0]['team1_score']): ?>
									<td class="brcornercell">							
										
									</td>		
									<?php else: ?>
									<td class="narrowvoidcell">							
										
									</td>								
									<?php endif; ?>
								</tr>								
							</table>	
						<?php endif; ?>
											
					<?php else: ?>
						<?php if ( fmod($y-pow(2, $x - 1), pow(2, $x)) == 0 || fmod($y - pow(2, $x - 2) - pow(2, $x - 1), pow(2, $x)) == 0 || fmod($y + pow(2, $x - 2) - pow(2, $x - 1), pow(2, $x)) == 0): ?>
						
							<?php if ($x > 1): ?>
								<table cellpadding = "0" cellspacing = "0" border="0" width="100%">							
									<tr>																			
										<td class="voidcellfull">
											
										</td>	
										<?php if (fmod($y - pow(2, $x - 2) - pow(2, $x - 1), pow(2, $x)) == 0):?>									
										<td class="lvlinecell">
											
										</td>	
										<?php elseif(fmod($y-pow(2, $x - 1), pow(2, $x)) == 0): ?>
										<td class="lcentercell">
										</td>
										<?php else: ?>
										<td class="narrowvoidcell">
											
										</td>																			
										<?php endif; ?>																					
									</tr>															
									<tr>									
										<?php if (fmod($y-pow(2, $x - 1), pow(2, $x)) == 0):?>
											<td class="voidcellfull" style="text-align:center">
												
											</td>	
											<td class="lvlinecell">
											
											</td>																																														
										<?php endif; ?>																		
										<?php if (fmod($y - pow(2, $x - 2) - pow(2, $x - 1), pow(2, $x)) == 0):?>
											
											<td class="playercell">
												&nbsp;&nbsp;---&nbsp;&nbsp;
											</td>																			
											<td class="brcornercell">
												
											</td>		
										<?php $drawLine[$x] = false; ?>		
										<?php endif; ?>
										<?php if (fmod($y + pow(2, $x - 2) - pow(2, $x - 1), pow(2, $x)) == 0):?>
																													
											<td class="playercell">							
												&nbsp;&nbsp;---&nbsp;&nbsp;
											</td>
											<td class="trcornercell">
												
											</td>																			
										<?php $drawLine[$x] = true; ?>
										<?php endif; ?>										
									</tr>							
									<tr>																																								
										<td class="voidcellfull">
											
										</td>	
										<?php if (fmod($y + pow(2, $x - 2) - pow(2, $x - 1), pow(2, $x)) == 0 || fmod($y-pow(2, $x - 1), pow(2, $x)) == 0):?>										
										<td class="lvlinecell">
											
										</td>	
										<?php else: ?>
										<td class="narrowvoidcell">
											
										</td>									
										<?php endif; ?>																			
									</tr>								
								</table>
							<?php else: ?>
								<table cellpadding = "0" cellspacing = "0" border="0" width="100%">		
								<tr>																			
									<td class="playercell">							
										&nbsp;&nbsp;---&nbsp;&nbsp;
									</td>		

									<td class="trcornercell">
										
									</td>																																			
								</tr>														
								<tr>																						
									<td class="voidcellfull" style="text-align:center">									
										
									</td>	
									<td class="lvlinecell">
										
									</td>																			
								</tr>																				
								<tr>																							
									<td class="playercell">
										&nbsp;&nbsp;---&nbsp;&nbsp;
									</td>		
									<td class="brcornercell">
										
									</td>
								</tr>								
							</table>
							<?php endif; ?>		
						<?php else: ?>		
							<?php if ($drawLine[$x]): ?>
							<table cellpadding = "0" cellspacing = "0" width="100%">	
								<tr>				
									<td class="voidcellfull">
										
									</td>
									<td class="lvlinecell">
										
									</td>																						
								</tr>	
								<tr>
									<td class="voidcellfull">
										
									</td>
									<td class="lvlinecell">
										
									</td>																						
								</tr>	
								<tr>
									<td class="voidcellfull">
									
									</td>																					
									<td class="lvlinecell">
										
									</td>																						
								</tr>									
							</table>
							<?php else: ?>	
							<table cellpadding = "0" cellspacing = "0" width="100%">	
								<tr>		
									<td class="voidcellfull">
									
									</td>																			
									<td class="narrowvoidcell">
										
									</td>	
																								
								</tr>	
								<tr>		
								   <td class="voidcellfull">
										
									</td>																					
									<td class="narrowvoidcell">
										
									</td>	
																														
								</tr>	
								<tr>	
								   <td class="voidcellfull">
									
									</td>																						
									<td class="narrowvoidcell">
										
									</td>																						
								</tr>								
							</table>
							<?php endif; ?>	
						<?php endif; ?>	

					<?php endif; ?>		
					
												
			</td>			
			<?php
				$x3 = $x2 + 1;
				$match = null;			
				foreach ($pmatches as $searchMatch)
					if ($searchMatch['Match']['tposition_x'] * (-1) == $x3 && ((pow(2, $x) * $searchMatch['Match']['tposition_y'] - pow(2, $x - 1)) == $y) && is_null($match))
						$match = $searchMatch;	
			?>
			 <td align="center">
					<?php if (!empty($match)):?>
					
						
							<table cellpadding = "0" cellspacing = "0" border="0" width="100%">		
								<tr>																			
									<td class="playercell">							
										&nbsp;&nbsp;<?php echo $match['Team1']['tag'];?>&nbsp;&nbsp;
									</td>		
									
									<td class="trcornercell">							
										
									</td>		
																															
								</tr>														
								<tr>																						
									<td class="voidcellfull" style="text-align:center">									
										<?php if (count($match['Result']) > 0): ?>	
											<?php echo $match['Result'][0]['team1_score']; ?><?php echo " : "; ?><?php echo $match['Result'][0]['team2_score'];?>
										<?php endif; ?>
									</td>	
									<td class="lcentercell">
									
									</td>																				
								</tr>																				
								<tr>																							
									<td class="playercell">
										&nbsp;&nbsp;<?php echo $match['Team2']['tag'];?>&nbsp;&nbsp;
									</td>		
										
										<td class="brcornercell">							
											
										</td>		
									
								</tr>								
							</table>
						
											
					<?php else: ?>
						<?php if ( fmod($y-pow(2, $x - 1), pow(2, $x)) == 0): ?>
						
							
								<table cellpadding = "0" cellspacing = "0" border="0" width="100%">		
								<tr>																			
									<td class="playercell">							
										&nbsp;&nbsp;---&nbsp;&nbsp;
									</td>		
									<td class="trcornercell">
										
									</td>	
								</tr>														
								<tr>																						
									<td class="voidcellfull" style="text-align:center">									
										
									</td>	
									
								<td class="lcentercell">
										
									</td>																											
								</tr>																				
								<tr>																							
									<td class="playercell">
										&nbsp;&nbsp;---&nbsp;&nbsp;
									</td>		
									<td class="brcornercell">
										
									</td>
								</tr>								
							</table>
								
						<?php else: ?>		
							<?php if ($drawLine[$x]): ?>
							<table cellpadding = "0" cellspacing = "0" width="100%">	
								<tr>				
									<td class="voidcellfull">
										
									</td>
									<td class="narrowvoidcell">
										
									</td>																						
								</tr>	
								<tr>
									<td class="voidcellfull">
										
									</td>
									<td class="narrowvoidcell">
										
									</td>																						
								</tr>	
								<tr>
									<td class="voidcellfull">
									
									</td>																					
									<td class="narrowvoidcell">
										
									</td>																						
								</tr>									
							</table>
							<?php else: ?>	
							<table cellpadding = "0" cellspacing = "0" width="100%">	
								<tr>		
									<td class="voidcellfull">
									
									</td>																			
									<td class="narrowvoidcell">
										
									</td>	
																								
								</tr>	
								<tr>		
								   <td class="voidcellfull">
										
									</td>																					
									<td class="narrowvoidcell">
										
									</td>	
																														
								</tr>	
								<tr>	
								   <td class="voidcellfull">
									
									</td>																						
									<td class="narrowvoidcell">
										
									</td>																						
								</tr>								
							</table>
							<?php endif; ?>	
						<?php endif; ?>	

					<?php endif; ?>													
			</td>		
			<?php endfor;?>
		</tr>
		<?php endfor;?>
		</table>
	<?php //endif; ?>
	</div>

	<?php endif; ?>
	
	</div>

