<?php
echo $javascript->link('prototype');
echo $javascript->link('popup');
echo $javascript->link('effects');
echo $javascript->link('scriptaculous');

echo $javascript->link('controls');
?>

<script type="text/javascript">
	function toggleAwards()
	{
		$('toggleAwards').toggle();
		$('toggleAwardsButton').toggle();
	}

	function toggleBetts()
	{
		$('toggleBetts').toggle();
		$('toggleBettsButton').toggle();
	}

	function toggleRules()
	{
		$('toggleRules').toggle();
		$('toggleRulesButton').toggle();
	}
	
	function toggleTables()
	{
		$('toggleTables').toggle();
		$('toggleTablesButton').toggle();		
	}
	
	function toggleGroups()
	{
		$('toggleGroups').toggle();
		$('toggleGroupsButton').toggle();		
	}
	
	function toggleGroups()
	{
		$('toggleGroups').toggle();
		$('toggleGroupsButton').toggle();

	}
	
	function toggleTeams()
	{
		$('toggleTeams').toggle();
		$('toggleTeamsButton').toggle();
	
	}
	
	function toggleMatches()
	{
		$('toggleMatches').toggle();
		$('toggleMatchesButton').toggle();
	}
	
	function toggleStatistics()
	{
		$('toggleStatistics').toggle();
		$('toggleStatisticsButton').toggle();
	}
	
	function toggleUpcomingMatches()
	{
		$('toggleUpcomingMatches').toggle();
		$('toggleAllMatches').toggle();
		$('toggleUpcomingMatchesButton').toggle();
		$('toggleAllMatchesButton').toggle();
	}
	
	function refresh()
	{
		$('toggleOpenAllMatches').value = ($('toggleAllMatches').style.display == "none" ? 0 : 1);
	
		$('toggleOpenStatistics').value = ($('toggleStatistics').style.display == "none" ? 0 : 1);		
		$('toggleOpenMatches').value = ($('toggleMatches').style.display == "none" ? 0 : 1);
		$('toggleOpenTeams').value = ($('toggleTeams').style.display == "none" ? 0 : 1);
		if ($('toggleGroups') != null)
			$('toggleOpenGroups').value = ($('toggleGroups').style.display == "none" ? 0 : 1);
		$('toggleOpenTables').value = ($('toggleTables').style.display == "none" ? 0 : 1);
		//$('toggleOpenRules').value =  ($('toggleRules').style.display == "none" ? 0 : 1);
		$('dontCache').value = '1';
		
		$('EventViewForm').submit();
	} 
</script>

<?php 
	foreach ($nominations as $id => $nom)	
		$nominations[$id] = __($nom, true);	
?>


<?php

if ($event['Event']['status'] == 'signup') {
	$openRules = true;
	$openTeams = true;
}
else
{
	$openRules = false;
	$openTeams = false;
}

if ($event['Event']['status'] == 'active') {

	if (!$groupsPlayed)
	$openGroups = true;
	else
	$openGroups = false;
		
	$openMatches = true;
	$openAllMatches = false;
	$openBetts = true;
}
else
{
	$openBetts = false;
	$openGroups = false;
	$openMatches = false;
	$openAllMatches = false;
}

if ($event['Event']['status'] == 'closed' || $event['Event']['status'] == 'finished') {
	$openStatistics = true;
}
else
$openStatistics = false;

if (!empty($pmatches)) {
	$openTables = true;
	//$openGroups = true;
}
else
{
	//$openGroups = false;
	$openTables = false;
	$openTeams = true;
	$openStatistics = false;
}




if (isset($this->data['Event']['toggleOpenMatches']))
if ($this->data['Event']['toggleOpenMatches'])
$openMatches = true;
else
$openMatches = false;

if (isset($this->data['Event']['toggleOpenStatistics']))
if ($this->data['Event']['toggleOpenStatistics'])
$openStatistics = true;
else
$openStatistics = false;

if (isset($this->data['Event']['toggleOpenTeams']))
if ($this->data['Event']['toggleOpenTeams'])
$openTeams = true;
else
$openTeams = false;
	
if (isset($this->data['Event']['toggleOpenTables']))
if ($this->data['Event']['toggleOpenTables'])
$openTables = true;
else
$openTables = false;

if (isset($this->data['Event']['toggleOpenAllMatches']))
if ($this->data['Event']['toggleOpenAllMatches'])
$openAllMatches = true;
else
$openAllMatches = false;

?>


<?php
echo $form->create('Event', array('action' => 'view/' . $event['Event']['id'], 'id' => 'EventViewForm'));

echo $form->hidden('toggleOpenAllMatches', array('id' => 'toggleOpenAllMatches'));

echo $form->hidden('toggleOpenGroups', array('id' => 'toggleOpenGroups'));
echo $form->hidden('toggleOpenMatches', array('id' => 'toggleOpenMatches'));
//echo $form->hidden('toggleOpenRules', array('id' => 'toggleOpenRules'));
echo $form->hidden('toggleOpenTables', array('id' => 'toggleOpenTables'));
echo $form->hidden('toggleOpenTeams', array('id' => 'toggleOpenTeams'));
echo $form->hidden('toggleOpenStatistics', array('id' => 'toggleOpenStatistics'));
echo $form->hidden('dontCache', array('id' => 'dontCache', 'value' => '0'));
	
echo $form->end();
?>

<div class="events view list">
<table cellspacing='0' cellpadding='0' border='0'>
	<tr>
		<td style="width: 100px; vertical-align: top"><?php	echo $html->image($event['Game']['avatar'], array('width' => '96', 'height' => '96')); ?>
		</td>
		<td style="width: 20px"></td>
		<td style="width: 360px; vertical-align: top">
		<table class="list" border="0">
			<tr>
				<td><?php __('Game'); ?></td>
				<td><?php echo $event['Game']['name']; ?></td>
			</tr>
			<tr>
				<td><?php __('Eventtype'); ?></td>
				<td><?php echo $event['Event']['teamsize']; ?>on<?php echo $event['Event']['teamsize']; ?>
				<?php echo $event['Eventtype']['name']; ?></td>
			</tr>
			<tr>
				<td><?php __('Eventsize'); ?></td>
				<td><?php echo $event['Event']['teamcount']; ?></td>
			</tr>
			<tr>
				<td><?php __('Admin'); ?></td>
				<td><?php echo $event['User']['name']; ?></td>
			</tr>
			<tr>
				<td><?php __('Start'); ?></td>
				<td><?php 
				if ($event['Event']['status'] == 'finished')
				{
					__('Finished');
				}
				else
				{
					if ($event['Event']['startdate'])
					{
						echo substr($event['Event']['startdate'], 2, 14);
							
					}
					else
					{
						echo __('When enough teams approved', true);
					}


				}
				?></td>
			</tr>
			<tr>
			<?php if($userIsAdmin):  ?>
				<td colspan="2">
				<table>
					<tr>
						<?php if(($event['Event']['status'] == 'finished')):  ?>
						<td>
						<table cellspacing="0" cellpadding="0">
							<tr>
								<td style="vertical-align: middle;"><?php echo $html->image('/img/event/award.png') ?>
								</td>
								<td style="vertical-align: middle;"><?php echo $html->link(__('Awards', true), "javascript: void(0);", array('onClick' => 
															"openWindow('".$html->url(array('controller'=>'events','action'=>'award', $event['Event']['id']))."', '".$event['Event']['name']."');"
															)); ?></td>
							</tr>
						</table>
						</td>
						<?php endif; ?>
												
						<?php if(($event['Event']['status'] == 'signup' && $event['Event']['startdate']) || $event['Event']['status'] == 'closed'):  ?>
						<td>
						<table cellspacing="0" cellpadding="0">
							<tr>
								<td style="vertical-align: middle;"><?php echo $html->image('/img/event/start.png') ?>
								</td>
								<td style="vertical-align: middle;"><?php { echo $html->link(__('Start cup', true), array('controller'=> 'events', 'action'=>'start', $event['Event']['id'])); } ?>
								</td>
							</tr>
						</table>
						</td>
						<?php endif; ?>
						<?php if(($event['Event']['status'] == 'signup' && $event['Event']['startdate']) || $event['Event']['status'] == 'active'):  ?>
						<td>
						<table cellspacing="0" cellpadding="0">
							<tr>
								<td style="vertical-align: middle;"><?php echo $html->image('/img/event/close.png') ?>
								</td>
								<td style="vertical-align: middle;"><?php { echo $html->link(__('Close cup', true), array('controller'=> 'events', 'action'=>'close', $event['Event']['id'])); } ?>
								</td>
							</tr>
						</table>
						</td>
						<?php endif; ?>
						<?php if($event['Event']['status'] == 'active'):  ?>
						<td>
						<table cellspacing="0" cellpadding="0">
							<tr>
								<td style="vertical-align: middle;"><?php echo $html->image('/img/event/finish.png') ?>
								</td>
								<td style="vertical-align: middle;"><?php { echo $html->link(__('Finish cup', true), array('controller'=> 'events', 'action'=>'finish', $event['Event']['id']) ); } ?>
								</td>
							</tr>
						</table>
						</td>
						<?php endif; ?>
						<?php if($event['Event']['status'] == 'active' && $event['Eventtype']['groups'] && $userCanStartPlayoff):  ?>
						<td>
						<table cellspacing="0" cellpadding="0">
							<tr>
								<td style="vertical-align: middle;"><?php echo $html->image('/img/event/playoff.png') ?>
								</td>
								<td style="vertical-align: middle;"><?php { echo $html->link(__('Start playoff', true), array('controller'=> 'events', 'action'=>'playoff', $event['Event']['id']) ); } ?>
								</td>
							</tr>
						</table>
						</td>
						<?php endif; ?>
					</tr>
				</table>

				</td>
				<?php else: ?>
					<?php if(($event['Event']['status'] == 'signup') && ($event['Eventtype']['restrict'] == '0')):  ?>
						<td>
							<table cellspacing="0" cellpadding="0">
								<tr>
									<td style="vertical-align: middle;">
										<?php echo $html->image('/img/event/sign.png') ?>
									</td>
									<td style="vertical-align: middle;">
										<?php { echo $html->link(__('Signup', true), array('controller'=> 'events', 'action'=>'sign', $event['Event']['id'])); } ?>
									</td>
								</tr>
							</table>
						</td>
					<?php else: ?>
						<td></td>
					<?php endif; ?>
				<?php endif; ?>
			</tr>
		</table>
		</td>
		<td style="width: 240px; vertical-align: top; text-align: right;">
			<?php if ($event['Org']['logo_url']): ?>
				<img src="<?php echo $event['Org']['logo_url']; ?>" />
			<?php else: ?>
				<?php // <img src="/img/uploads/logos/no_logo.jpg" /> ?>
			<?php endif; ?>
		</td>
	</tr>
</table>


</div>
<br />
<br />

<?php if (!empty($event['Award'])): ?>
<div class="related" id="toggleAwardsButton" style="display:none">
<div class="caption clickable" onclick="javascript:toggleAwards();"><img
	src="/img/closed.gif" alt="" />&nbsp;<?php __('Awards');?></div>
</div>

<div class="related" id="toggleAwards" style="display:block" >
<div class="caption clickable" onclick="javascript:toggleAwards();"><img
	src="/img/open.gif" alt="" />&nbsp;<?php __('Awards');?></div>
<br />
<div>
<table cellpadding="5" cellspacing="0" width="50%">
<?php foreach($event['Award'] as $award): ?>	
	<tr>
		<td><?php echo $nominations[$award['nomination_id']]; ?> - </td>		
		<td><?php echo $teamList[$award['team_id']]; ?></td>		
	</tr>
<?php endforeach; ?>
</table>
</div>
</div>
<br />
<br />
<?php endif; ?>

<?php if ($event['Eventtype']['groups'] == '1'): ?>
<div class="related" id="toggleGroupsButton" style="display:<?php echo ($openGroups ? "none" : "block") ?>">
<div class="caption clickable" onclick="javascript:toggleGroups();"><img
	src="/img/closed.gif" alt="" />&nbsp;<?php __('Groups');?></div>
</div>

<div class="related" id="toggleGroups" style="display:<?php echo ($openGroups ? "block" : "none") ?>" >
<div class="caption clickable" onclick="javascript:toggleGroups();"><img
	src="/img/open.gif" alt="" />&nbsp;<?php __('Groups');?></div>
<br />
<div>
<table cellpadding="5" cellspacing="0" width="100%">

<?php


//	Groups sort logic

function cmpTeamPoints($a, $b) { return $b["points"] - $a["points"]; }

foreach ($groups as $groupkey => $group)
{
	foreach($group['Team'] as $teamkey => $groupteam)
	{
		$groupTeamMatches1 = Set::extract("/Match[team1_id=".$groupteam['id']."]", $group);
		$groupTeamMatches2 = Set::extract("/Match[team2_id=".$groupteam['id']."]", $group);
			
		$groupTeamTotal = count($groupTeamMatches1) +  count($groupTeamMatches2);
		$groupTeamWon = 0;
		$groupTeamLost = 0;
		$groupTeamDraw = 0;

		$groupTeamResults1 = Set::extract("/Result[matchpart_id=1]",
		Set::extract("/Match[team1_id=".$groupteam['id']."][grouptable_id=".$group['Grouptable']['id'].
														"]/../Result", $matches));								
		foreach($groupTeamResults1 as $result)
		{
			if ($result['Result']['team1_score'] > $result['Result']['team2_score']) $groupTeamWon++;
			if ($result['Result']['team1_score'] < $result['Result']['team2_score']) $groupTeamLost++;
			if ($result['Result']['team1_score'] == $result['Result']['team2_score']) $groupTeamDraw++;
		}
			
		$groupTeamResults2 = Set::extract("/Result[matchpart_id=1]",
		Set::extract("/Match[team2_id=".$groupteam['id']."][grouptable_id=".$group['Grouptable']['id'].
														"]/../Result", $matches));
		foreach($groupTeamResults2 as $result)
		{
			if ($result['Result']['team2_score'] > $result['Result']['team1_score']) $groupTeamWon++;
			if ($result['Result']['team2_score'] < $result['Result']['team1_score']) $groupTeamLost++;
			if ($result['Result']['team2_score'] == $result['Result']['team1_score']) $groupTeamDraw++;
		}

		$groups[$groupkey]['Team'][$teamkey]['won'] = $groupTeamWon;
		$groups[$groupkey]['Team'][$teamkey]['lost'] = $groupTeamLost;
		$groups[$groupkey]['Team'][$teamkey]['draw'] = $groupTeamDraw;
		$groups[$groupkey]['Team'][$teamkey]['total'] = $groupTeamWon + $groupTeamLost + $groupTeamDraw;
		$groups[$groupkey]['Team'][$teamkey]['matches'] = $groupTeamTotal;
		$groups[$groupkey]['Team'][$teamkey]['points'] = $groupTeamWon * $event['Eventtype']['winpoints'] + $groupTeamLost * $event['Eventtype']['loosepoints'] +
		$groupTeamDraw * $event['Eventtype']['drawpoints'];
	}

	usort($groups[$groupkey]['Team'], "cmpTeamPoints");

}




?>


<?php $i = 0; ?>

<?php foreach ($groups as $group): ?>
<?php $i++; ?>

<?php if ($i % 2 > 0): ?>
	<tr>
		<td width="50%"><?php elseif ($i % 2 == 0): ?>
		
		
		<td width="50%"><?php endif; ?>

		<table cellpadding="5" cellspacing="0" width="100%"
			bordercolor="#111111" border="1" style="border-collapse: collapse;">
			<tr>
				<td colspan="5" style="text-align: center"><br />
				<?php echo $group['Grouptable']['name'] ?> <br />
				<br />
				</td>

			</tr>

			<tr>
				<th bgcolor="#c0c0c0" align="center"><?php __("Team"); ?></th>
				<th bgcolor="#c0c0c0" align="center"><?php __("Played"); ?></th>
				<th bgcolor="#c0c0c0" align="center"><?php __("Won"); ?></th>
				<th bgcolor="#c0c0c0" align="center"><?php __("Lost"); ?></th bgcolor="#c0c0c0">
				<th bgcolor="#c0c0c0" align="center"><?php __("Points"); ?></th>
			</tr>

			<?php foreach($group['Team'] as $groupteam): ?>


			<tr>
				<td style="text-align: center"><?php echo $groupteam['name'] ?></td>
				<td style="text-align: center"><?php echo $groupteam['total'] ?>/<?php echo $groupteam['matches'] ?>
				</td>
				<td style="text-align: center"><?php echo $groupteam['won'] ?></td>
				<td style="text-align: center"><?php echo $groupteam['lost'] ?></td>
				<td style="text-align: center"><?php echo $groupteam['points'] ?></td>
			</tr>
			<?php endforeach; ?>
		</table>

		<?php if ($i % 2 > 0): ?></td>
		<?php elseif ($i % 2 == 0): ?>
		</td>
	</tr>
	<?php endif; ?>


	<?php endforeach; ?>

</table>
</div>
</div>
<br />
<br />
	<?php endif; ?>

<div class="related" id="toggleTablesButton" style="display:<?php echo ($openTables ? "none" : "block") ?>">
<div class="caption clickable" onclick="javascript:toggleTables();"><img
	src="/img/closed.gif" alt="" />&nbsp;<?php __('Event Tables');?></div>
</div>

<div class="related" id="toggleTables" style="display:<?php echo ($openTables ? "block" : "none") ?>" >
<div class="caption clickable" onclick="javascript:toggleTables();"><img
	src="/img/open.gif" alt="" />&nbsp;<?php __('Event Tables');?></div>
<br />

	<?php if (!empty($event['Playofftable'])):?> 
		<?php echo $this->renderElement('playofftable');?>
	<?php else:?>
		<div class="view">
			<?php __("No playoff table"); ?>
		</div>
	<?php endif;?>
	</div>
<br />
<br />

<div class="related" id="toggleMatchesButton" style="display:<?php echo ($openMatches ? "none" : "block") ?>">
<div class="caption clickable" onclick="javascript:toggleMatches();"><img
	src="/img/closed.gif" alt="" />&nbsp;<?php __('Event Matches');?></div>
</div>
<div class="related" id="toggleMatches" style="display:<?php echo ($openMatches ? "block" : "none") ?>" >
<div class="caption clickable" onclick="javascript:toggleMatches();"><img
	src="/img/open.gif" alt="" />&nbsp;<?php __('Event Matches');?></div>
<div>
<table style="text-align: right;" cellpadding="0" cellspacing="0"
	border="0" width="100%">
	<tr>
		<td style="width: 99%"></td>
		<td style="text-align: right">
			<div id="toggleAllMatchesButton" style="display:<?php echo (!$openAllMatches ? "block" : "none") ?>">
				<table class="clickable">
					<tr>
						<td>
							<table style="background-color: #e7e7e7;">
								<tr>
									<td style="background-color: #f5f5f5;">
										<a class="nonunderline"	onclick="toggleUpcomingMatches();"><?php __('Allf'); ?></a>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
		</td>
		<td>
		<div  id="toggleUpcomingMatchesButton"  style="display:<?php echo ($openAllMatches ? "block" : "none") ?>">
		<table class="clickable">
			<tr>
				<td>
					<table style="background-color: #e7e7e7;">
						<tr>
							<td style="background-color: #f5f5f5;">
								<a class="nonunderline" onclick="toggleUpcomingMatches();"><?php __('Upcoming'); ?></a>
							</td>
						</tr>
					</table>
				</td></tr></table>
		</div>
		</td>
</tr>
</table>
</div>

<div id="toggleAllMatches" style="display:<?php echo ($openAllMatches ? "block" : "none") ?>">

	<?php if (!empty($matches)):?>
<table cellpadding="1" cellspacing="1" class="list">

<?php
$i = 0;
foreach ($matches as $match):
$class = null;
if ($i++ % 2 == 0) {
	$class = ' class="altrow"';
}
?>
	<tr <?php echo $class;?>>


		<td align="center"><?php if ($match['Match']['date']): ?> <?php echo substr($match['Match']['date'],2,14);?>
		<?php else: ?> &nbsp;&nbsp; - &nbsp;&nbsp; <?php endif; ?></td>



		<?php if (count($match['Result']) < 1): ?>
		<td align="right"><?php echo $match['Team1']['name'];?></td>
		<td align="center">vs.</td>
		<td align="left"><?php echo $match['Team2']['name'];?></td>
		<?php endif; ?>
		<?php if (count($match['Result']) > 0): ?>
		<td align="right"><?php echo $match['Team1']['name'];?></td>
		<td align="center"><?php echo $match['Result'][0]['team1_score'];?> :
		<?php echo $match['Result'][0]['team2_score'];?></td>
		<td align="left"><?php echo $match['Team2']['name'];?></td>
		<?php endif; ?>


		<td style="vertical-align: middle;">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td style="vertical-align: middle;"><?php echo $html->image('/img/match/magnif.png') ?>
				</td>
				<td style="vertical-align: middle;"><?php echo $html->link(__('Details', true),  '/match/' . $match['Match']['id'] . ':' . slug($match['Team1']['name'] .' vs '. $match['Team2']['name']), array('target' => '_blank') ); ?>
				</td>
			</tr>
		</table>
		</td>



		<?php if ($userIsAdmin): ?>
		<td style="vertical-align: middle;">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td style="vertical-align: middle;"><?php echo $html->image('/img/match/edit.png') ?>
				</td>
				<td style="vertical-align: middle;"><?php echo $html->link(__('Edit', true), "javascript: void(0);", array('onClick' => 
											"openWindow('".$html->url(array('controller'=>'matches','action'=>'edit', $match['Match']['id']))."', '".$event['Event']['name']."');"
											)); ?></td>
			</tr>
		</table>
		</td>

		<?php if (count($match['Result']) > 0): ?>
		<td style="vertical-align: middle;">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td style="vertical-align: middle;"><?php echo $html->image('/img/match/edit.png') ?>
				</td>
				<td style="vertical-align: middle;"><?php echo $html->link(__('Edit result', true), "javascript: void(0);", array('onClick' => 
											"openWindow('".$html->url(array('controller'=>'results','action'=>'edit', $match['Result'][0]['id']))."', '".$event['Event']['name']."');"
											)); ?></td>
			</tr>
		</table>
		</td>
		<?php endif; ?>

		<?php if (count($match['Result']) < 1): ?>
		<td style="vertical-align: middle;">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td style="vertical-align: middle;"><?php echo $html->image('/img/match/add.png') ?>
				</td>
				<td style="vertical-align: middle;"><?php echo $html->link(__('New result', true), "javascript: void(0);", array('onClick' => 
											"openWindow('".$html->url(array('controller'=>'results','action'=>'add', $match['Match']['id']))."', '".$event['Event']['name']."');"
											)); ?></td>
			</tr>
		</table>
		</td>
		<?php endif; ?>
		<td style="vertical-align: middle;">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td style="vertical-align: middle;"><?php echo $html->image('/img/match/del.png') ?>
				</td>
				<td style="vertical-align: middle;"><?php echo $html->link(__('Delete', true), array('controller'=>'matches','action'=>'delete', $match['Match']['id']))?>
				</td>
			</tr>
		</table>
		</td>
		<?php endif; ?>
	</tr>
	<?php endforeach; ?>
</table>
	<?php else: ?>
<div class="view"><?php __("No matches"); ?></div>
	<?php endif; ?></div>

<div id="toggleUpcomingMatches" style="display:<?php echo (!$openAllMatches ? "block" : "none") ?>">

	<?php if (!empty($matches)):?>
<table cellpadding="1" cellspacing="1" class="list">
<?php
$i = 0;
foreach ($matches as $match): ?>
<?php if (count($match['Result']) < 1): ?>

<?php
$class = null;
if ($i++ % 2 == 0) {
	$class = ' class="altrow"';
}
?>
	<tr <?php echo $class;?>>


		<td align="center"><?php if ($match['Match']['date']): ?> <?php echo substr($match['Match']['date'],2,14);?>
		<?php else: ?> &nbsp;&nbsp; - &nbsp;&nbsp; <?php endif; ?></td>

		<td align="right"><?php echo $match['Team1']['name'];?></td>
		<td align="center">vs.</td>
		<td align="left"><?php echo $match['Team2']['name'];?></td>


		<td style="vertical-align: middle;">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td style="vertical-align: middle;"><?php echo $html->image('/img/match/magnif.png') ?>
				</td>
				<td style="vertical-align: middle;"><?php echo $html->link(__('Details', true), '/match/' . $match['Match']['id'] . ':' . slug($match['Team1']['name'] .' vs '. $match['Team2']['name']), array('target' => '_blank'))?>
				</td>
			</tr>
		</table>
		</td>

		<?php if ($userIsAdmin): ?>
		<td style="vertical-align: middle;">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td style="vertical-align: middle;"><?php echo $html->image('/img/match/edit.png') ?>
				</td>
				<td style="vertical-align: middle;"><?php echo $html->link(__('Edit', true), "javascript: void(0);", array('onClick' => 
											"openWindow('".$html->url(array('controller'=>'matches','action'=>'edit', $match['Match']['id']))."', '".$event['Event']['name']."');"
											))?></td>
			</tr>
		</table>
		</td>
		<td style="vertical-align: middle;">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td style="vertical-align: middle;"><?php echo $html->image('/img/match/add.png') ?>
				</td>
				<td style="vertical-align: middle;"><?php echo $html->link(__('New result', true), "javascript: void(0);", array('onClick' => 
											"openWindow('".$html->url(array('controller'=>'results','action'=>'add', $match['Match']['id']))."', '".$event['Event']['name']."');"
											)); ?></td>
			</tr>
		</table>
		</td>
		<td style="vertical-align: middle;">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td style="vertical-align: middle;"><?php echo $html->image('/img/match/del.png') ?>
				</td>
				<td style="vertical-align: middle;"><?php echo $html->link(__('Delete', true), array('controller'=>'matches','action'=>'delete', $match['Match']['id']))?>
				</td>
			</tr>
		</table>
		</td>

		<?php endif; ?>

	</tr>

	<?php endif; ?>
	<?php endforeach; ?>
	<?php if ($i == 0): ?>
	<tr>
		<td align="center"><?php __("No upcoming matches"); ?></td>
	</tr>
	<?php endif; ?>
</table>


	<?php else: ?>
<div class="view"><?php __("No matches"); ?></div>
<?php endif; ?> <?php if($userIsAdmin): ?> <br />
<div>
<table cellspacing="0" cellpadding="0">
	<tr>
		<td style="vertical-align: middle;"><?php echo $html->image('/img/match/add.png') ?>
		</td>
		<td style="vertical-align: middle;"><?php echo $html->link(__('New match', true), "javascript: void(0);", array('onClick' => 
						"openWindow('".$html->url(array('controller'=>'matches','action'=>'add', $event['Event']['id']))."', '".$event['Event']['name']."');"
						)); ?></td>
	</tr>
</table>
</div>
						<?php endif; ?></div>




</div>
<br />
<br />

<div class="related" id="toggleTeamsButton" style="display:<?php echo ($openTeams ? "none" : "block") ?>">
<div class="caption clickable" onclick="javascript:toggleTeams();"><img
	src="/img/closed.gif" alt="" />&nbsp;<?php __('Event Teams');?></div>
</div>
<div class="related" id="toggleTeams" style="display:<?php echo ($openTeams ? "block" : "none") ?>" >
<div class="caption clickable" onclick="javascript:toggleTeams();"><img
	src="/img/open.gif" alt="" />&nbsp;<?php __('Event Teams');?></div>
<br />


						<?php if (!empty($teams)):?>

<table cellpadding="1" cellspacing="1" class="list">
	<tr>
		<th><?php ($event['Event']['teamsize'] > 1 ? __('Title') : __('Name'));?></th>
		<?php if ($event['Event']['teamsize'] > 1): ?>
		<th><?php __('Owner'); ?></th>
		<?php endif; ?>
		<th><?php __('Status'); ?></th>
		<?php if($userIsAdmin): ?>
		<th></th>
		<?php endif; ?>
	</tr>
	<?php
	$i = 0;
	foreach ($teams as $team):
	$class = null;
	if ($i++ % 2 != 0) {
		$class = ' class="altrow"';
	}
	?>
	<tr <?php echo $class;?>>
		<td><?php echo $html->link($team['Team']['name'], array('controller'=>'teams','action'=>'view', $team['Team']['id']), array('target' => '_blank')); ?>
		</td>
		<?php if ($event['Event']['teamsize'] > 1): ?>
		<td>
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td style="vertical-align: middle;"><?php echo $html->image('/img/orgs/member.png') ?>
				</td>
				<td style="vertical-align: middle;"><?php echo $html->link($team['User']['username'], array('controller'=>'users','action'=>'view', $team['User']['id']), array('target' => '_blank')); ?>
				</td>
			</tr>
		</table>
		</td>
		<?php endif; ?>

		<?php if ($team["Pool"]["level"]):  ?>
		<td><?php if ($team["Pool"]["level"] == "S") { echo __("Unapproved", true); } ?>
		<?php if ($team["Pool"]["level"] == "A") { echo __("Approved", true); } ?>
		<?php if ($team["Pool"]["level"] == "K") { echo __("Kicked", true); } ?></td>
		<?php if($userIsAdmin): ?>
		<td><?php if ($team["Pool"]["level"] == "S"):?> <a>
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td style="vertical-align: middle;"><?php echo $html->image('/img/match/check.png') ?>
				</td>
				<td style="vertical-align: middle;"><?php { echo $html->link(__("Approve", true), array('controller'=>'events','action'=>'approve', $event['Event']['id'], $team['Team']['id'])); } ?>
				</td>
			</tr>
		</table>
		<?php endif; ?> </a></td>
		<?php endif; ?>
		<?php endif; ?>
	</tr>
	<?php endforeach; ?>
</table>


	<?php else: ?>
<div class="view"><?php __("No teams"); ?></div>
	<?php endif; ?>
	
		<?php if($userIsAdmin): ?> <br />
<div class="teamplayers form"><?php echo $form->create('Event', array('action'=>'sign'));?>
	<?php 
		if ($event['Event']['teamsize'] == '1' && $event['Eventtype']['restrict'] != 1)
			$type = 'solo';
		//if ($event['Event']['teamsize'] == '1' && $event['Eventtype']['restrict'] == 1)
		//	$type = 'vip';
			
	?>
	<?php echo $ajax->autocomplete("Team.name", "/teams/autocomplete" . '/' . $event['Event']['game_id'] . '/' . $type, array('class' => 'auto', 'minChars' => 1)); ?>

	<?php echo $form->input('id', array('type'=>'hidden', 'value' => $event['Event']['id']));?>

<br />
<br />
	<?php echo $form->end(strtoupper(__('Sign', true)));?></div>
	<?php endif; ?> 
	</div>
<br />
<br />


<div class="related" id="toggleStatisticsButton" style="display:<?php echo ($openStatistics ? "none" : "block") ?>">
<div class="caption clickable" onclick="javascript:toggleStatistics();"><img
	src="/img/closed.gif" alt="" />&nbsp;<?php __('Statistics');?></div>
</div>
<div class="related" id="toggleStatistics" style="display:<?php echo ($openStatistics ? "block" : "none") ?>" >
<div class="caption clickable" onclick="javascript:toggleStatistics();"><img
	src="/img/open.gif" alt="" />&nbsp;<?php __('Statistics');?></div>
<br />

	<?php echo $this->renderElement('statistics_event', array('event_id' => $event['Event']['id']));?>

</div>

<br />
<br />

<div class="related" id="toggleBettsButton" style="display:<?php echo ($openBetts ? "none" : "block") ?>">
<div class="caption clickable" onclick="javascript:toggleBetts();"><img	src="/img/closed.gif" alt="" />&nbsp;<?php __('Betts');?></div>
</div>
<div class="related" id="toggleBetts" style="display:<?php echo ($openBetts ? "block" : "none") ?>" >
<div class="caption clickable" onclick="javascript:toggleBetts();"><img src="/img/open.gif" alt="" />&nbsp;<?php __('Betts');?></div>

<br/>


<table style="width: 100%;" border="0">
	<tr>		
		<td style="width: 50%;vertical-align:top;">
			<?php if (!empty($betts)): ?>
			<table cellpadding="1" cellspacing="1" class="list">
			<?php foreach ($betts as $bett):?>
				<tr>
					<td><?php echo $nominations[$bett['Awardbett']['nomination_id']]; ?> - </td>		
					<td><?php echo $teamList[$bett['Awardbett']['team_id']]; ?></td>						
					<td class="altrow">$<?php echo $bett['Awardbett']['sum']; ?></td>			
					<td><i><?php echo $bett['User']['name']; ?></i></td>
			
					<?php if ($bett['Awardbett']['won'] > 0): ?>
					<td style="text-align: right">&nbsp;+ <font color="green">$<?php echo $bett['Awardbett']['won'] - $bett['Awardbett']['sum']; ?></font>
					</td>
					<?php endif; ?>
				</tr>
				<?php endforeach; ?>			
			</table>
			<?php else: ?>		
				<?php __("No betts"); ?>		
			<?php endif; ?>
		</td>
		<td style="width: 50%;vertical-align:top;">
			<?php if ($othAuth->sessionValid()): ?>	
				<?php if ( $event['Event']['status'] == 'active'): ?>														
					<?php echo $form->create('Awardbett', array('url' => '/betts/addawardbett'));?>	 
						<?php
							echo $form->input('event_id', array("type" => "hidden","value" => $event['Event']['id']));
							echo $form->select('nomination_id', $nominations, null, array(), false);
							echo $form->select('team_id', $teamList, null, array(), false);
							echo $form->input('sum', array('label' => __('Your betting points', true)));		
											
						?>	
					<br/>
					<?php echo $form->end(strtoupper(__('Submit', true)));?>
				<?php endif; ?>
				<br/>
			<?php endif; ?>														
		</td>
	</tr>
							
</table>

</div>