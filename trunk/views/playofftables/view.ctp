
<div class="playofftables view">	
	<div align="center">
		<?php //if (!empty($playofftable['Match'])):?>
		<table cellpadding = "3" cellspacing = "3">
			<tr>
			<?php for ($i = 1;$i <= log($playofftable['Playofftable']['size'], 2); $i++):?>
				<th><?php __('Playoff round'); ?>&nbsp;<?php echo $i; ?></th>
			<?php endfor;?>
			</tr>
			<?php for ($y = 1;$y <= $playofftable['Playofftable']['size']; $y++):?>
			<tr>
			<?php for ($x = 1;$x <= log($playofftable['Playofftable']['size'], 2); $x++):		
				$match = null;			
				foreach ($matches as $searchMatch)
					if ($searchMatch['Match']['tposition_x'] == $x && ((pow(2, $x) * $searchMatch['Match']['tposition_y'] - pow(2, $x - 1)) == $y) && is_null($match))
						$match = $searchMatch;		
			?>
				<td align="center" >
					<?php if (!empty($match)):?>
					<div class="altcell">
						<table cellpadding = "1" cellspacing = "1">	
							<tr>														
								<?php if (count($match['Result']) > 0): ?>	
								<td><?php echo $match['Team1']['tag'];?>&nbsp;<?php echo $match['Result'][0]['team1_score']; ?><?php echo " : "; ?><?php echo $match['Result'][0]['team2_score'];?>&nbsp;<?php echo $match['Team2']['tag'];?></td>
								<?php else:?>
								<td><?php echo $match['Team1']['tag'];?><?php echo " : "; ?><?php echo $match['Team2']['tag'];?></td>
								<?php endif; ?>																								
							</tr>										
						</table>					
					</div>		
											
					<?php else: ?>
						<?php if ( fmod($y-pow(2, $x - 1), pow(2, $x)) == 0): ?>
							<div class="altcell">---</div>
						<?php else: ?>		
							<div>&nbsp;</div>
						<?php endif; ?>	

					<?php endif; ?>													
				</td>
			<?php endfor;?>
			</tr>
		<?php endfor;?>
		</table>
		<?php //endif; ?>
	</div>
	
	<?php if ($playofftable['Playofftable']['type'] == 'D'):?>
	<div align="center">
		<table cellpadding = "3" cellspacing = "3">
			<tr>
				<th><?php __('Final'); ?></th>		
			</tr>
			<tr>		
				<td align="center">
				<?php 	
				$match = null;			
				foreach ($matches as $searchMatch)
				if (($searchMatch['Match']['tposition_x'] == 0 && $searchMatch['Match']['tposition_y']  == 0) && is_null($match))
					$match = $searchMatch;		
				?>		
				<?php if (!empty($match)):?>
					<div class="altcell">
						<table cellpadding = "1" cellspacing = "1">	
							<tr>														
								<?php if (count($match['Result']) > 0): ?>	
								<td><?php echo $match['Team1']['tag'];?>&nbsp;<?php echo $match['Result'][0]['team1_score']; ?><?php echo " : "; ?><?php echo $match['Result'][0]['team2_score'];?>&nbsp;<?php echo $match['Team2']['tag'];?></td>
								<?php else:?>
								<td><?php echo $match['Team1']['tag'];?><?php echo " : "; ?><?php echo $match['Team2']['tag'];?></td>
								<?php endif; ?>																								
							</tr>										
						</table>					
					</div>		
				<?php else: ?>
					<div class="altcell">---</div>
				<?php endif; ?>													
									
				</td>
			</tr>
		</table>
	</div>
	
	<br/>
	
	<div align="center">	
	<?php //if (!empty($playofftable['Match'])):?>
		<table cellpadding = "3" cellspacing = "3">		
		<tr>
			<?php for ($i = 1;$i <= log($playofftable['Playofftable']['size'] / 2, 2) * 2; $i++):?>
				<th><?php __('Loser round'); ?>&nbsp;<?php echo $i; ?></th>
			<?php endfor;?>
		</tr>
		<?php for ($y = 1;$y <= $playofftable['Playofftable']['size'] / 2; $y++):?>
		<tr>
			<?php for ($x = 1;$x <= log($playofftable['Playofftable']['size'] / 2, 2); $x = $x + 1):					
				if ($x == 1) $x2 = 1;
				else $x2 = $x * 2 - 1;
				$match = null;
				foreach ($matches as $searchMatch)
					if ($searchMatch['Match']['tposition_x'] * (-1) == $x2 && ((pow(2, $x) * $searchMatch['Match']['tposition_y'] - pow(2, $x - 1)) == $y) && is_null($match))
						$match = $searchMatch;		
			?>
			<td align="center">
				<?php if (!empty($match)):?>
				<div class="altcell">
					<table cellpadding = "1" cellspacing = "1">	
						<tr>														
							<?php if (count($match['Result']) > 0): ?>	
							<td><?php echo $match['Team1']['tag'];?>&nbsp;<?php echo $match['Result'][0]['team1_score']; ?><?php echo " : "; ?><?php echo $match['Result'][0]['team2_score'];?>&nbsp;<?php echo $match['Team2']['tag'];?></td>
							<?php else:?>
							<td><?php echo $match['Team1']['tag'];?><?php echo " : "; ?><?php echo $match['Team2']['tag'];?></td>
							<?php endif; ?>																								
						</tr>										
					</table>					
				</div>		
				<?php else: ?>
					<?php if ( fmod($y-pow(2, $x - 1), pow(2, $x)) == 0): ?>
						<div class="altcell">---</div>
					<?php else: ?>		
						<div >&nbsp;</div>
					<?php endif; ?>	

				<?php endif; ?>												
			</td>			
			<?php
				$x3 = $x2 + 1;
				$match = null;			
				foreach ($matches as $searchMatch)
					if ($searchMatch['Match']['tposition_x'] * (-1) == $x3 && ((pow(2, $x) * $searchMatch['Match']['tposition_y'] - pow(2, $x - 1)) == $y) && is_null($match))
						$match = $searchMatch;	
			?>
			 <td align="center">
				<?php if (!empty($match)):?>
				<div class="altcell">
					<table cellpadding = "1" cellspacing = "1">	
						<tr>														
							<?php if (count($match['Result']) > 0): ?>	
							<td><?php echo $match['Team1']['tag'];?>&nbsp;<?php echo $match['Result'][0]['team1_score']; ?><?php echo " : "; ?><?php echo $match['Result'][0]['team2_score'];?>&nbsp;<?php echo $match['Team2']['tag'];?></td>
							<?php else:?>
							<td><?php echo $match['Team1']['tag'];?><?php echo " : "; ?><?php echo $match['Team2']['tag'];?></td>
							<?php endif; ?>																								
						</tr>										
					</table>					
				</div>		
				<?php else: ?>
					<?php if ( fmod($y-pow(2, $x - 1), pow(2, $x)) == 0): ?>
						<div class="altcell">---</div>
					<?php else: ?>		
						<div>&nbsp;</div>
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
