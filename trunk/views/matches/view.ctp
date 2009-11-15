
<div class="view">
<table style="width: 100%;">
	<tr>
		<td style="text-align:center;">
				
				<table class="caption" style="width: 100%;height:10px" >	
					<tr>								
						<td width="40%" style="text-align:left;font-size:16px;">
							&nbsp;<?php echo $html->link($match['Team1']['name'], array('controller'=> 'teams', 'action'=>'view', $match['Team1']['id']), array("class" => "nonunderline")); ?>
						</td>
						<?php if (count($match['Result']) > 0): ?>	
							<td width="7%" style="text-align:right;font-size:14px;<?php echo ($match['Result'][0]['team1_score'] <  $match['Result'][0]['team2_score'] ? 'color:red' : 'color:green'); ?>">
								<?php echo $match['Result'][0]['team1_score']; ?>
							</td>
							<td width="6%">											
								<?php echo "vs"; ?>
							</td>
							<td width="7%" style="text-align:left;font-size:14px;<?php echo ($match['Result'][0]['team1_score'] >  $match['Result'][0]['team2_score'] ? 'color:red' : 'color:green'); ?>">			
								<?php echo $match['Result'][0]['team2_score'];?>
							</td>
						<?php else:?>
							<td width="20%" style="text-align:center">											
								<?php echo "vs"; ?>
							</td>									
						<?php endif; ?>																		
						<td width="40%" style="text-align:right;font-size:16px;">
							<?php echo $html->link($match['Team2']['name'], array('controller'=> 'teams', 'action'=>'view', $match['Team2']['id']), array("class" => "nonunderline")); ?>&nbsp;				
						</td>			
					</tr>										
				</table>								
		</td>
	</tr>
</table>


		<br>
		
		<table style="width: 100%;">
			
			<tr>
				<td> 
					<div class="caption"><?php __('Info');?></div>
					<br/>
					<table class="list" >
						<tr>		
							<td><?php __('Event'); ?></td>
							<td>
								<?php echo $html->link($match['Event']['name'], array('controller'=> 'events', 'action'=>'view', $match['Event']['id'])); ?>						
							</td>
						</tr>						
							<tr>
								<td><?php __('Date'); ?></td>
								<td>
									<?php if ($match["Match"]["date"]) echo $match["Match"]["date"]; else __("Undecided");?>						
								</td>
							</tr>
						<?php //endif; ?>
					</table>
				
		
				
				
				</td>
				
				<?php if($match['Event']['teamsize'] != 1): ?>
				<td style="vertical-align:top; width:50%;">
					<div class="caption"><?php __('Squad');?></div>
					<br/>
					<table class="list" >
						<tr>		
							<td style="vertical-align:top"><?php echo $match['Team1']['name']; ?>:</td>
							<td style="vertical-align:top">
								<?php foreach ($players1 as $p){
										echo (isset($p['username']) ? $p['username'] : $p['name']) . " ";
								} ?>			
							</td>
						</tr>
						<tr>
							<td><?php echo $match['Team2']['name']; ?>:</td>		
							<td>			
								<?php foreach ($players2 as $p){
										echo (isset($p['username']) ? $p['username'] : $p['name']). " ";
								} ?>			
													
							</td>
						</tr>
						 					 							
					</table>
					
				</td>
				<?php endif; ?>
			</tr>
		
		</table>

<br/>		
<div class="caption"><?php __('Maps');?></div>
<br/>	

		<?php if (!empty($results)):?>
			<table cellpadding = "1" cellspacing = "1" class="list">	
			<?php
				$i = 0;
				foreach ($results as $result):
					$class = null;
					if ($i++ % 2 != 0) {
						$class = ' class="altrow"';
					}
				?>
				<tr<?php echo $class;?>>
					<td><?php echo $result['Map']['title'];?></td>						
					<td><?php echo $result['Result']['team1_score'];?></td>
					<td><?php echo ":"; ?></td>			
					<td><?php echo $result['Result']['team2_score'];?></td>			
					<td>(<?php echo __($result['Matchpart']['title'], true);?>)</td>	
					<!-- 								
					<td>
						<?php if (count($result['Resultdemo']) > 0):?>
							<?php foreach($result['Resultdemo'] as $demo) 
									echo $html->link($demo['title'], $demo['url'])  . "&nbsp;";	
							?>				
						<?php endif;?>				
					</td>
					<td>
						<?php if (count($result['Resultpicture']) > 0):?>
							<?php foreach($result['Resultpicture'] as $pic) 
									echo $html->link($pic['title'], array('url'=>$pic['url'])) . "&nbsp;";	
							?>								
						<?php endif; ?>
					</td>
					 -->						
				</tr>
			<?php endforeach; ?>
			</table>
			<?php else: ?>
			<div class="view">
				<?php __("No results."); ?>
			</div>
			<?php endif; ?>
		
			<br/>
			
		<!-- 
		<?php if($userIsAdmin): ?>
			<div class="list view">
				<?php echo $form->button(strtoupper(__('New result', true)), array("class"=>"knopke", "div"=>false, "onclick"=>"window.location='" . $html->url(array('controller'=> 'results', 'action'=>'add', $match["Match"]["id"])) . "'")); ?>			
			</div>
		<?php endif; ?>			
 		-->
 		
 		
<br/>


<div class="caption"><?php __('Betts');?></div>
<br/>
<table style="width: 100%;" border="0">
	<tr>		
		<td style="width: 50%;vertical-align:top;">
			<?php echo $this->renderElement('latestbetts', array('match_id'=>$match['Match']['id']));?>
		</td>
		<td style="width: 50%;vertical-align:top;">	
			<?php if ((!isset($match['Result'][0]) && !isset($match['Result'][0]) || (strtotime($match['Match']['date']) < time()))): ?>														
				<?php echo $form->create('Bett');?>	 
					<?php
						echo $form->input('match_id', array("type" => "hidden","value" => $match['Match']['id']));
						echo $form->select('team_id', array($match['Team1']['id'] => $match['Team1']['name'], $match['Team2']['id'] => $match['Team2']['name']), null, array(), false);
						echo $form->input('sum', array('label' => __('Your betting points', true)));
						echo $form->input('odds', array("type" => "hidden"));		
					?>	
				<br/>
				<?php echo $form->end(strtoupper(__('Submit', true)));?>
			<?php endif; ?>
			<br/>														
		</td>
	</tr>
							
</table>

</div>



			
<br/>
<br/>			

<?php echo $this->renderElement('comments', array('cache'=>false, 'commentsModel' => 'Matchcomment', 'commentParentName' => 'match_id', 'commentParentValue' => $match['Match']['id']));?>

