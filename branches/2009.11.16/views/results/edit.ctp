<?php
	$translatedMatchParts = array();
	foreach ($matchparts as $key => $mp)		
	{
		$i = 0;
		$translatedMatchParts[$key] = __($mp, true);
	}
?>
<div class="view list">
	<div class="caption">
		<?php __('Edit result');?>
	</div>
	<br/>
		
	<?php echo $form->create('Result');?>
	<?php
		echo $form->input('id');
		echo $form->input('match_id', array('type' => 'hidden'));
		
	?>
					
	 	<table cellpadding="1" cellspacing="1" class="list">		 		
	 		<tr>
	 			<th>
	 				<?php echo $form->label($match["Team1"]["name"]); ?>
	 			</th>
	 			<th>
	 				<?php echo $form->label($match["Team2"]["name"]); ?>
	 			</th>
	 			<th>
	 				<?php echo $form->label(__('Matchpart',true)); ?>
	 			</th>
	 			<th>
	 				<?php echo $form->label(__('Map',true)); ?>
	 			</th>
	 			<th>
	 				
	 			</th>	
	 			<th>
	 				
	 			</th>	
	 		</tr>
	 		<?php 
	 			foreach ($match["Result"] as $result)
	 			{
	 		?>
	 			<?php if ($result["id"] != $this->data["Result"]["id"]): ?>
	 			<tr>
		 		
		 			<td>			
					<?php
						echo $result["team1_score"];
					?>
					</td>
					<td>		
					<?php
						echo $result["team2_score"];
					?>
					</td>	
					<td>		
					<?php							
						echo __($matchparts[$result["matchpart_id"]], true);
					?>	
					</td>	
					<td>	
					<?php								
						echo $maps[$result["map_id"]];
					?>
					</td>	
					<td>	
						<table cellspacing="0" cellpadding="0">
							<tr>
								<td style="vertical-align: middle;">
									<?php echo $html->image('/img/match/edit.png') ?>
								</td>
								<td style="vertical-align: middle;">
									<?php		
										echo $html->link(__("Edit", true), array("action" => "edit" ,  $result["id"]));
									?>
								</td>																
							</tr>
						</table>	
					</td>	
					<?php if (!($result["matchpart_id"] == 1 && count($match["Result"]) > 1)): ?>	
					<td>	
						<table cellspacing="0" cellpadding="0">
								<tr>
									<td style="vertical-align: middle;">
										<?php echo $html->image('/img/match/del.png') ?>
									</td>
									<td style="vertical-align: middle;">
										<?php echo $html->link(__('Delete', true), array('controller'=>'results','action'=>'delete', $result["id"], $result["match_id"]))?>
									</td>																
								</tr>
						</table>	
					</td>	
					<?php endif; ?>				
				</tr>
	 			<?php else: ?>
		 		<tr>
		 		
		 			<td>			
					<?php
						echo $form->input('team1_score', array ("label" => false, "div" => false, "style"=>"width:20px"));
					?>
					</td>
					<td>		
					<?php
						echo $form->input('team2_score', array ("label" => false, "div" => false, "style"=>"width:20px"));
					?>
					</td>	
					<td>		
					<?php								
						echo $form->select('matchpart_id', ($result["matchpart_id"] != 1 ? array_slice($translatedMatchParts, 1, count($translatedMatchParts)-1, true) : $translatedMatchParts), null, array ("label" => false, "div" => false, "disabled" => $result["matchpart_id"] == 1 ? "true" : "false"), false);
					?>	
					</td>	
					<td>	
					<?php		
						echo $form->input('map_id', array ("label" => false, "div" => false));
					?>
					</td>	
					<td>	
					<?php		
						echo $form->submit(__('Submit', true), array('onClick' => "getElementById('ResultEditForm').submit();afterEdit();"));
					?>
					</td>	
					<?php if (!($result["matchpart_id"] == 1 && count($match["Result"]) > 1)): ?>	
					<td>	
						<table cellspacing="0" cellpadding="0">
								<tr>
									<td style="vertical-align: middle;">
										<?php echo $html->image('/img/match/del.png') ?>
									</td>
									<td style="vertical-align: middle;">
										<?php echo $html->link(__('Delete', true), array('controller'=>'results','action'=>'delete', $result["id"], $result["match_id"]))?>
									</td>																
								</tr>
						</table>	
					</td>	
					<?php endif; ?>	
				</tr>
				<?php endif; ?>
			<?php 
				}
			?>
		</table>
		
	<?php echo $form->end();?>
	<br/>
	
	<table cellspacing="0" cellpadding="0">
		<tr>
			<td style="vertical-align: middle;">
				<?php echo $html->image('/img/match/add.png') ?>
			</td>
			<td style="vertical-align: middle;">
				<?php echo $html->link(__('New result', true), array('controller'=>'results','action'=>'add', $match['Match']['id']))?>	
			</td>																
		</tr>
	</table>	
	<br/>
	<br/>
	<br/>
	<br/>	
	<div align="center">
		<?php echo $html->link(__('Close this window', true), 'javascript:shutWindow();')?>
	</div>
			
	
</div>

