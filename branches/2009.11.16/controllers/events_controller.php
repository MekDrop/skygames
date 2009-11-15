<?php
class EventsController extends AppController {

	var $name = 'Events';
	
	var $helpers = array('Html', 'Form', 'Session', 'Javascript', 'Ajax', 'Cache');
			
	var $uses = array('Event', 'Team', 'Pool', 'Nomination', 'Awardbett', 'Award');
	
	var $cacheAction = array(
	 'view/' => "+1 hour",
	 'event/' => "+1 hour",	
	 'index' => "+1 hour",
	 );	
	 
	/**
	 * @var Model
	 */
	var $Event;
	
	function afterFilter()
	{
					
		
	}
	
	function index() {
		
		$this->Event->recursive = 0;		

		$conditions = $this->formatFilterConditions( array('game_id', 'org_id') );
										
		$this->paginate = array('Event' => array('limit' => 10, 'page' => 'first', 'order' => 'Event.created DESC', 'conditions' =>  $conditions));

       

		$events = $this->paginate();

		$orgs = $this->Event->Pool->Team->User->Org->find('list');
		$games = $this->Event->Game->find('list');		
		
		$this->set('events', $events);
		$this->set('orgs', $orgs);
		$this->set('games', $games);	

		$this->contentHelpers = false;
		
	}
	
	function latest()
	{
		$this->Event->recursive = 0;

		$events = $this->Event->findAll(null, null, 'Event.created DESC', 6);
		if(isset($this->params['requested'])) {		 	 
             return $events;
        } 
		else
		$this->set('events', $events);
	}
	
	function chooseteam($id = null) {
		
		if (!$id)
		{
			$this->Session->setFlash(__('Invalid event id', true));		
			$this->redirect('/');
			exit();				
		}
		else
			$event = $this->Event->read(null, $id);		 
		
		//	User is not loged
		if (!$this->othAuth->user('id'))
		{
			$this->Session->setFlash(__('You have login to sign up', true));		
			$this->redirect(array('controller'=>'users','action'=>'login'));	
			exit();		
		}		
			

		//	Apply different logic to solo tournament signup then to team tournament						
		if ($event['Event']['teamsize'] == 1)
		{
			$teams = $this->Event->Pool->Team->findAll(array('user_id' => $this->othAuth->user('id'), 'game_id' => $event['Event']['game_id']));
			
			$soloTeamId = false;
			
			foreach ($teams as $team)
			{
				if ($team['Team']['type'] == 'solo')
				{
					$soloTeamId = $team['Team']['id'] ;
					break;
				}
			}
			
			if (!$soloTeamId)
			{				
				$this->Event->Pool->Team->create();
				$soloTeam["Team"] = array ("user_id" => $this->othAuth->user('id'), "name" => $this->othAuth->user('username'), "tag" => $this->othAuth->user('username'), "type" => "solo", "game_id" => $event['Event']['game_id']);

				if (!$this->Event->Pool->Team->save($soloTeam))
				{
					$this->Session->setFlash(__('Error has occured while trying to create solo team', true));		
					$this->redirect(array('controller'=>'teams','action'=>'add',$this->othAuth->user('id')));								
				}
				
				$soloTeamId = $this->Event->Pool->Team->getLastInsertID();
			} 
			
			$this->redirect(array('action'=>'sign', $id, $soloTeamId));
			exit();
		}
		else
		{
			$teams = $this->Event->Pool->Team->findAll(array('user_id' => $this->othAuth->user('id'), 'game_id' => $event['Event']['game_id'], array ('NOT' => array('type' => 'solo'))),
														null, null, null, -1);
			
			//	User has no teams
			if (count($teams) < 1)
			{
				$this->Session->setFlash(__('You have to create team first to sign up', true));		
				$this->redirect(array('controller'=>'teams','action'=>'add',$this->othAuth->user('id')));
				exit();			
			}	
			//	We have 1 team
			elseif (count($teams) == 1)
			{			
				$this->redirect(array('action'=>'sign', $id, $teams[0]['Team']['id']));		
				exit();						
			}
			//	We have multiple teams, we give user a choice
			else
			{
				$this->set('teams', $teams);
				$this->set('id', $id);
			}
		}
	}
	
	
	
	function sign($id = null, $team_id = null) {
		
		
		//	For autocomplete fields
		

		if ($id == null && isset($this->data["Event"]["id"]))
			$id = $this->data["Event"]["id"];			
		
		//	check ok
		if (!$id) {		
			$this->Session->setFlash(__('You can\'t signup for this event', true));		
			$this->redirect(array('action'=>'index'));
			exit();
		}	
		
		
		$appedCount = $this->Event->Pool->findCount(array('event_id'=>$id, 'level' => 'A'));
		$event = $this->Event->read(null, $id);
		
		if ($team_id == null && isset($this->data["Team"]["name"]))
		{
			$team = $this->Event->Pool->Team->find(array("name" => $this->data["Team"]["name"], "game_id" => $event['Event']['game_id']), array("id"), null, -1);
			$team_id = $team['Team']['id'];
		}
		
		if ($event["Event"]["teamcount"] <= $appedCount)
		{		
			$this->Session->setFlash(__('The event is full', true));		
			$this->redirect(array('controller'=>'events','action'=>'view', $id));
			exit();
		}			
		
		//	team chosen
		if ($team_id)
		{
			$myTeam = $this->Event->Pool->Team->read(null, $team_id);
			
			$signed = false;
			foreach ($myTeam['Venue'] as $event)
				if ($event['id'] == $id) $signed = true;
				
			if ($signed)	
			{		
				$this->Session->setFlash(__('The team is already signed', true));		
				$this->redirect(array('controller'=>'events','action'=>'view', $id));
				exit();
			}	
				
			$userIsAdmin = $this->othAuth->group("level") >= 300 || $this->Event->User->Staff->findCount(array ('Staff.user_id' => $this->othAuth->user('id'), 'Staff.org_id' => $event['Event']['org_id']));			
				
			//	have permision
			if ( (!empty($myTeam) && $myTeam['Team']['user_id'] == $this->othAuth->user('id')) || $userIsAdmin)
			{
				
				//	validate
				
				
								
				//	save															
				$this->Event->Pool->create();		
				if ($this->Event->Pool->save( array ('team_id' => $myTeam['Team']['id'], 'event_id' => $id, 'status' => 'S')))					
				{					
					$this->Session->setFlash(__('You have successfully signed up', true));		
					$this->redirect(array('controller'=>'events','action'=>'view', $id));		
					exit();
				}
				else
				{			
					$this->Session->setFlash(__('Unexpected error.', true));
					$this->redirect(array('controller'=>'events','action'=>'view', $id));
					exit();
				}
					

			}
			else 
			{
				
				$this->Session->setFlash(__('You can\'t signup this team', true));		
				$this->redirect(array('action'=>'index'));				
				exit();
			}
		}
		//	team not chosen
		else 
		{
			$this->Session->setFlash(__('Choose team to sign up', true));
			$this->redirect(array('action'=>'chooseteam', $id));
			exit();
		}	
				
		
	}

	function kick($id = null, $team_id = null)
	{	
		if (!$id) {
			$this->flash(__('Invalid Event', true), array('action'=>'index'));
		}
		
		if ($this->Event->Pool->deleteAll(array("event_id"=>$id, "team_id"=>$team_id))) {
			$this->flash(__('Team kicked', true), true);
			$this->redirect(array('action'=>'index'));
			
		}
	}
	
	function approve($id = null, $team_id = null)
	{
		if (!$id) {
			$this->flash(__('Invalid Event', true), array('action'=>'index'));
		}
				
				
		$ident = array('Pool.event_id'=>$id, 'Pool.team_id'=>$team_id);
		$signedTeam = $this->Event->Pool->findCount($ident);
		
		if (!empty($signedTeam))
		{

			if ($this->Event->Pool->updateAll(array('level'=>'\'A\''), $ident))
			{		
				//	Check if we are good to go
				$cnt = $this->Event->Pool->findCount(array("event_id"=>$id, "level"=>"A"));
				$teams = $this->Event->Pool->findAll(array("event_id"=>$id, "level"=>"A"));			
				$event = $this->Event->read(null, $id);	
					
				if ($event["Event"]["teamcount"] == $cnt && !$event["Event"]["startdate"])
				{
					
					if ($event["Event"]["status"] == "signup" && !$event['Eventtype']['groups'])
					{						
						$table = Set::extract("/Playofftable[name=".$event['Event']['name']."]", $event);
						if ($table)
						{							
							$this->generateInitialMatchesElminitation($id, $table["0"]["Playofftable"]["id"], $teams);
						}
					}
					elseif ($event["Event"]["status"] == "signup" && $event['Eventtype']['groups'] && $event['Event']['gengroups'] > 0)
					{										
						$groups = $this->Event->Grouptable->findAll(array("Grouptable.event_id" => $event["Event"]["id"]));
						
						$this->generateInitialMatchesGroups($id, $groups, $teams);									
						
						$this->Session->setFlash(__('Event started. Groups generated.', true));							
											
					}	
						
					
					if ($this->Event->updateAll(array("status"=>'"active"'), array("Event.id" => $id)))					
						$this->Session->setFlash(__('Team approved', true));
					
					
					$this->redirect(array('action'=>'view', $id));							
				}				
				
			
			}		
			else
			{			
				$this->Session->setFlash(__('Uexpected error', true));
				$this->redirect(array('action'=>'view', $id));
			}	
		}

		$this->redirect(array('action'=>'view', $id));
	}
	
	
	
	
	
	function view($id = null) {		
		
		if (!$id) {
			$this->flash(__('Invalid Event', true), array('action'=>'index'));
		}
		
		
		
		
		$areBigTables = false;
		
		
		if ($this->data["Event"]["dontCache"] == '1')
			$this->cacheAction = false;
		
		
		$event = $this->Event->read(null, $id);
				
		$userIsAdmin = $this->othAuth->group("level") >= 300 || $this->Event->User->Staff->findCount(array ('Staff.user_id' => $this->othAuth->user('id'), 'Staff.org_id' => $event['Event']['org_id']));
				
		$matches = $this->Event->Match->findAll(array('Match.event_id'=>$id));
		
		//$playofftables = $this->Event->Playofftable->findAll(array('events_id'=>$id));		
		$groups = $this->Event->Grouptable->findAll( array('event_id'=>$id) );
		
		$groupMatchesVsResults = $this->Event->query("SELECT count(matches.id) matchCount, count(results.id) resultCount FROM matches
														LEFT JOIN results ON results.match_id = matches.id AND results.matchpart_id = 1
														JOIN grouptables ON matches.grouptable_id = grouptables.id
														WHERE grouptables.event_id = " . $id);
		
		$areGroupsPlayed =  ($groupMatchesVsResults['0']['0']['matchCount'] == $groupMatchesVsResults['0']['0']['resultCount']) && $groupMatchesVsResults['0']['0']['matchCount'] > 0;
		
		$nominations = $this->Nomination->findAll(array ('eventtype_id' => $event['Eventtype']['id']), array ('Nomination.id', 'Awardtype.name') );
		$nominations = Set::combine($nominations, '{n}.Nomination.id', '{n}.Awardtype.name');
		
		$awardbetts = $this->Awardbett->findAll(array ('event_id' => $event['Event']['id']), null, 'Awardbett.created DESC', 10);
		
		if (($areGroupsPlayed) and ($groupMatchesVsResults['0']['0']['resultCount'] == count($matches))) 
			$canStartPlayoff = true;
		else
			$canStartPlayoff = false;
		
			
		$this->Team->unbindAll();
		$this->Team->bindModel( array ( 'belongsTo' => array( 'User' => array('className' => 'User', 'foreignKey' => 'user_id') ) ) );
			
		$teams = $this->Team->find('all', array('joins' => array( array('table' => 'pools', 'alias' => 'Pool', 'type' => 'INNER', 'foreignKey' => false, 
																	'conditions'=> array( 'Pool.team_id = Team.id', 'Pool.event_id = ' . $id ) ) ),
												'fields' => array('Pool.*', 'User.*', 'Team.*')
								  )); 
								  
		$teamList = Set::combine($teams, '{n}.Team.id', '{n}.Team.name');
					
		if (!empty($event['Playofftable']))
		{
			$this->set('playofftable', array ( 'Playofftable' => $event['Playofftable'][0]) );				
			$pmatches = Set::extract('/Match[playofftable_id=' . $event['Playofftable'][0]['id'] . ']/..', $matches);			
			$this->set('pmatches', $pmatches);
		}
		else
		{
			$this->set('tables', false);	
			$this->set('playofftable', false);
			$this->set('pmatches', false);
		}
		
		
		$this->set('event', $event);
		$this->set('matches', $matches);
		$this->set('teams', $teams);
		$this->set('groups', $groups);
		$this->set('userIsAdmin', $userIsAdmin);
		$this->set('userCanStartPlayoff', $canStartPlayoff);		
		$this->set('groupsPlayed', $areGroupsPlayed);
		$this->set('nominations', $nominations);
		$this->set('teamList', $teamList);
		$this->set('betts', $awardbetts);
		
		
		$this->contentHelpers = false;
		
		$this->titleForContent = '<b>' . $event["Event"]["name"] . '</b>';
		
	}

	
	function generateInitialMatchesElminitation($event_id, $tid, $teams, $shuffle = true)
	{
		if ($shuffle)
			shuffle($teams);
		
		$i = 1;
		for ($n=0;$n<=count($teams)-2;$n=$n+2)
		{
			$m["Match"] = array();
			$m["Match"]["id"] = "";
			$m["Match"]["event_id"] = $event_id;
			$m["Match"]["team1_id"] = $teams[$n]["Team"]["id"];
			$m["Match"]["team2_id"] = $teams[$n + 1]["Team"]["id"];
			$m["Match"]["playofftable_id"] = $tid;
			$m["Match"]["tposition_x"] = 1;
			$m["Match"]["tposition_y"] = $i;
			$this->Event->Match->save($m);
			$i++;
		}
		
	}
	
	function generateInitialMatchesGroups($event_id, $groups, $teams, $grouprounds = 1)
	{
		shuffle($teams);
		
		$grouptablematches = array();
		
		$offset = 0;
		
		foreach ($groups as $group)
		{
			$groupteams = array();
			
			//	Generate groups			
			$n = 0;				
			for ($n = 0; $n <= count($teams) / count($groups) - 1;$n++)
			{
				if (isset($teams[$offset + $n]))
				{
					$gt['Grouptableteam'] = array();
					$gt['Grouptableteam']['id'] = "";					
					$gt['Grouptableteam']['grouptable_id'] = $group['Grouptable']['id'];
					$gt['Grouptableteam']['team_id'] =  $teams[$offset + $n]["Team"]["id"];
					$this->Event->Grouptable->Grouptableteam->create();
					$this->Event->Grouptable->Grouptableteam->save($gt);
					$i++;
					$groupteams[] = $gt['Grouptableteam']['team_id'];					
				}
			}					
			$offset = $offset + $n;
			
			//	Generate matches in groups			
			$matches = array();
			
			foreach ($groupteams as $groupkey => $team1)
				foreach ($groupteams as $team2)
					{
						$alreadySet = 0;
						$alreadySet = count(Set::extract("/Match[team1_id=".$team2."][team2_id=".$team1."][grouptable_id=".$group['Grouptable']['id']."]", $matches)) + 
										count(Set::extract("/Match[team1_id=".$team1."][team2_id=".$team2."][grouptable_id=".$group['Grouptable']['id']."]", $matches)); 
						
						if ($alreadySet < $grouprounds && $team1 != $team2)
						{
							$groupmatches[$groupkey]['team1_id'] = $team1;
							$groupmatches[$groupkey]['team2_id'] = $team2; 
						
							$m["Match"] = array();
							$m["Match"]["id"] = "";
							$m["Match"]["event_id"] = $event_id;
							$m["Match"]["team1_id"] = $team1;
							$m["Match"]["team2_id"] = $team2;
							$m["Match"]["grouptable_id"] = $group['Grouptable']['id'];
							$this->Event->Match->save($m);
							$matches[] = $m;
						}						
					} 
			
			//$grouptablematches[] = $matches;
		}
		
		//	Generate matches in groups
		
	
		
	}
	
	function playoff($id = null)
	{
		
	
		if (!$id) {
			$this->flash(__('Invalid Event', true), array('action'=>'index'));
		}
		
		$event = $this->Event->read(null, $id);					
		
		$groupteams = $this->Event->query("		
										SELECT * FROM
										(
										SELECT id, sum(points) points, grouptable_id FROM 
										(
											SELECT  team1.name, team1.id,
												grouptable.id grouptable_id, 
												(select winpoints from eventtypes join events on events.eventtype_id = eventtypes.id where events.id = ".$id.") as points
											FROM grouptables AS grouptable										
											JOIN matches AS m ON grouptable.id = m.grouptable_id 
											JOIN teams AS team1 ON m.team1_id = team1.id
											LEFT JOIN results AS result ON result.match_id = m.id and result.matchpart_id = 1
											WHERE grouptable.event_id = ".$id."
											AND result.team1_score > result.team2_score 										
											union all										
											SELECT  team2.name, team2.id,
												grouptable.id grouptable_id, 
												(select winpoints from eventtypes join events on events.eventtype_id = eventtypes.id where events.id = ".$id.") as points
											FROM grouptables AS grouptable										
											JOIN matches AS m ON grouptable.id = m.grouptable_id 
											JOIN teams AS team2 ON m.team2_id = team2.id
											LEFT JOIN results AS result ON result.match_id = m.id and result.matchpart_id = 1
											WHERE grouptable.event_id = ".$id."
											AND result.team1_score < result.team2_score										
											union all										
											SELECT  team3.name, team3.id,
												grouptable.id grouptable_id, 
												(select drawpoints from eventtypes join events on events.eventtype_id = eventtypes.id where events.id = ".$id.") as points
											FROM grouptables AS grouptable										
											JOIN matches AS m ON grouptable.id = m.grouptable_id 
											JOIN teams AS team3 ON m.team1_id = team3.id or m.team2_id = team3.id
											LEFT JOIN results AS result ON result.match_id = m.id and result.matchpart_id = 1
											WHERE grouptable.event_id = ".$id."
											AND result.team1_score = result.team2_score
										) groupmatches
										group by groupmatches.id
										) as groupmatchesordered
										order by grouptable_id, points desc
									"); 
		$groupCount = count($event['Grouptable']);
		
		$teamsPerTable = $event['Event']['qualifycount'] / $groupCount;
		
		$setTeamsPerGroup = array ();
		
		$teams = array();
		
		foreach ($groupteams as $team)
		{			
			if (!isset($setTeamsPerGroup[$team['groupmatchesordered']['grouptable_id']]) ||
				$setTeamsPerGroup[$team['groupmatchesordered']['grouptable_id']] < $teamsPerTable )
			{
				if (!isset($setTeamsPerGroup[$team['groupmatchesordered']['grouptable_id']]))
					$setTeamsPerGroup[$team['groupmatchesordered']['grouptable_id']] = 1; 
				else
					$setTeamsPerGroup[$team['groupmatchesordered']['grouptable_id']] = $setTeamsPerGroup[$team['groupmatchesordered']['grouptable_id']] + 1;
				$teams[] = $team['groupmatchesordered']['id'];
			}
		}
		
		$playoffTeams = array ();
		
		for ($i = 0; $i <= $groupCount - 1; $i = $i + 2)
		{
			for ($j = 0; $j <= $teamsPerTable - 1; $j++)
			{
				$playoffTeams[] = array ( "Team" => array ( "id" => $teams[$i * $teamsPerTable + $j] ) );
				
				$playoffTeams[] = array ( "Team" => array ( "id" => $teams[(($i + 1) * $teamsPerTable) + $teamsPerTable - $j - 1] ) );
			}
									
		}
		
		$table = $this->Event->Playofftable->find(array("Playofftable.name" => $event["Event"]["name"]), array(), null, -1);
		
		$this->generateInitialMatchesElminitation($id, $table["Playofftable"]["id"], $playoffTeams, false);
				
		$this->Session->setFlash(__('Playoff generated.', true));										
		
		$this->redirect(array('action'=>'view', $id));
	}
	
	function start($id = null)
	{
		if (!$id) {
			$this->flash(__('Invalid Event', true), array('action'=>'index'));
		}
				
				
		//	Check if we are good to go
		$cnt = $this->Event->Pool->findCount(array("event_id"=>$id, "level"=>"A"));	
		$teams = $this->Event->Pool->findAll(array("event_id"=>$id, "level"=>"A")); 	
		$event = $this->Event->read(null, $id);	
			
		if ($event["Event"]["teamcount"] == $cnt && $event["Event"]["teamcount"])
		{								
			
			if ($this->Event->updateAll(array("status"=>'"active"'), array("Event.id" => $id)))
			{
				$table = Set::extract("/Playofftable[name=".$event['Event']['name']."]", $event);
				$groups = $this->Event->Grouptable->findAll(array("Grouptable.event_id" => $event["Event"]["id"]));
				
				//	Start event w/o groups
				if ($event["Event"]["status"] == "signup" && !$event['Eventtype']['groups'] && $table)
				{
					$this->generateInitialMatchesElminitation($id, $table["0"]["Playofftable"]["id"], $teams);									
					{
						$this->Session->setFlash(__('Event started. Table generated.', true));							
					}
				}	
				//	Start event with groups
				elseif ($event["Event"]["status"] == "signup" && $event['Eventtype']['groups'] && $groups && $event['Event']['gengroups'] > 0)
				{										
					$this->generateInitialMatchesGroups($id, $groups, $teams, $event['Event']['grouprounds']);									
					{
						$this->Session->setFlash(__('Event started. Groups generated.', true));							
					}					
				}						
				//	
				else
				{
					$this->Session->setFlash(__('Event started.', true) . " " . __('Matches not generated - bad status.', true));											
				}												
			}		
		}		
		else		
		{
			$this->Session->setFlash(__('Not enough teams approved or too many teams approved', true));											
		}		
		
		
		$this->redirect(array('action'=>'view', $id));
	}
	
	function close($id = null)
	{
		if (!$id) {
			$this->flash(__('Invalid Event', true), array('action'=>'index'));
		}		
		
		if ($this->Event->save( array("Event" => array( "status" => "closed", "id" => $id) ) ))
		{
			$this->Session->setFlash(__('Event closed', true));	
			$this->redirect(array('action'=>'view', $id));
		}					
	}
	
	function finish($id = null)
	{
		if (!$id) {
			$this->flash(__('Invalid Event', true), array('action'=>'index'));
		}

			if ($this->Event->save( array("Event" => array( "status" => "finished", "id" => $id) ) ))
			{
				$this->Session->setFlash(__('Event finished', true));	
				$this->redirect(array('action'=>'view', $id));
		}			
	}
	
	function award($id = null)
	{
		$this->layout = 'popup';
		Configure::write('debug', '2');		
		
		if (!$id) {
			$this->flash(__('Invalid Event', true), array('action'=>'index'));
		}

		if (!empty($this->data)) {
			$this->Award->create();	
			if ($this->Award->save( $this->data ))
			{
				//	Update odds
						
				$this->Award->query("				
						update awardbetts b set b.odds = 
						(
							select claim from
							(
								select (stake.sum / winsum * lostsum) / stake.sum as claim, id, bid, winsum, lostsum from 
						
								(select sum(awardbetts.sum) winsum from awardbetts where awardbetts.event_id = ".$this->data["Award"]["event_id"]."
								and awardbetts.team_id = ".$this->data["Award"]["team_id"]." and nomination_id = ".$this->data["Award"]["nomination_id"].") 
								 win
						
								join
									 
								(select sum(awardbetts.sum) lostsum from awardbetts where awardbetts.event_id = ".$this->data["Award"]["event_id"]."
								and awardbetts.team_id != ".$this->data["Award"]["team_id"]." and nomination_id = ".$this->data["Award"]["nomination_id"]."
								) lost
						
								join 
						
								(select awardbetts.sum, awardbetts.id as bid, awardbetts.user_id as id from awardbetts where awardbetts.event_id = ".$this->data["Award"]["event_id"]." and
								awardbetts.nomination_id = ".$this->data["Award"]["nomination_id"]." and awardbetts.team_id = ".$this->data["Award"]["team_id"]."
								) stake
							) odds
							where odds.bid = b.id
						)						
						where b.event_id = ".$this->data["Award"]["event_id"]." and b.team_id = ".$this->data["Award"]["team_id"]." and b.claimed != 1
				");
					
				//	Update sums
					
				$this->Award->query("update awardbetts b set b.won = sum * b.odds + sum
										where b.nomination_id = ".$this->data["Award"]["nomination_id"]." and b.event_id = ".$this->data["Award"]["event_id"]." and b.team_id = ".$this->data["Award"]["team_id"]." and b.claimed != 1");
					
				//	Update claims - user points
					
				$this->Award->query("
							update users u set 
								u.points = u.points + 
								(
								select sum(won) from awardbetts where awardbetts.nomination_id = ".$this->data["Award"]["nomination_id"]." and awardbetts.team_id = ".$this->data["Award"]["team_id"]." and awardbetts.event_id = ".$this->data["Award"]["event_id"]." and awardbetts.claimed != 1
								and awardbetts.user_id = u.id
								group by awardbetts.user_id 
								)
								where u.id in
								(
								select awardbetts.user_id from awardbetts where awardbetts.nomination_id = ".$this->data["Award"]["nomination_id"]." and awardbetts.team_id = ".$this->data["Award"]["team_id"]." and awardbetts.event_id = ".$this->data["Award"]["event_id"]." and awardbetts.claimed != 1
								)
				");
					
				//	Update bett status
					
				$this->Award->query("
					update awardbetts b set 
					b.claimed = 1
					where b.nomination_id = ".$this->data["Award"]["nomination_id"]." and b.team_id = ".$this->data["Award"]["team_id"]." and b.event_id = ".$this->data["Award"]["event_id"]."");
					
				/* End betts */
				
				
				$this->Session->setFlash(__('Award added', true));	
				$this->redirect(array('action'=>'view', $this->data["Award"]["event_id"]));
			}				
		}
		else
		{
			$event = $this->Event->read(null, $id);
			
			$nominations = $this->Nomination->findAll(array ('eventtype_id' => $event['Eventtype']['id']), array ('Nomination.id', 'Awardtype.name') );
			$nominations = Set::combine($nominations, '{n}.Nomination.id', '{n}.Awardtype.name');
			
			$teams = $this->Team->find('all', array('joins' => array( array('table' => 'pools', 'alias' => 'Pool', 'type' => 'INNER', 'foreignKey' => false, 
																	'conditions'=> array( 'Pool.team_id = Team.id', 'Pool.event_id = ' . $id ) ) ),
												'fields' => array('Pool.*', 'User.*', 'Team.*')
								  )); 
								  
			$teamList = Set::combine($teams, '{n}.Team.id', '{n}.Team.name');
			
			$this->set('nominations', $nominations);
			$this->set('teamList', $teamList);			
		
			$this->data['Award']['event_id'] = $id;
			
		}
		
		$this->titleForContent = __("Awards", true);
	}
	
	
	function add() {
		if (!empty($this->data)) {
			$this->data['Event']['user_id'] = $this->othAuth->user('id');
			
			$this->Event->create();						
			if ($this->Event->save($this->data)) {
				
				if (($this->data["Event"]["groups"] > 0) && ($this->data["Event"]["qualifycount"] > 0))
				{					
					$ptableSize	= $this->data["Event"]["groups"] * $this->data["Event"]["qualifycount"];
				}
				else
				{
					$ptableSize	= $this->data["Event"]["teamcount"];	
				}
				
				$eve = $this->Event->getLastInsertID();
				if ($this->data["Event"]["create_ptable"] != null)
				{
					$playofftable["Playofftable"] = array ("name" => $this->data["Event"]["name"], "type" => $this->data["Event"]["table_type"], 
														   "theme" => $this->data["Event"]["table_theme"],
														   "events_id" => $eve, "size" => $ptableSize);
					$this->Event->Playofftable->create();	
					$this->Event->Playofftable->save($playofftable);
				
				}
				
				if (($this->data["Event"]["groups"] > 0) && ($this->data["Event"]["qualifycount"] > 0))
				{
					for ($i=0;$i<$this->data["Event"]["groups"];$i++)
					{
						$this->Event->Grouptable->create();	
						$this->Event->Grouptable->save( array('Grouptable' => array ( 'name' => $this->data["Event"]["name"] . " GROUP " . chr(ord('A')+$i), 
																						'event_id' => $eve)) );
					}
				}
				
				$this->Session->setFlash(__('Event created', true));				
				$this->redirect(array('action'=>'view', $eve));		
				exit();
			} else {
				$this->Session->setFlash(__('Error has occured', true));				
				$this->redirect(array('action'=>'view', $eve));		
				exit();
			}
		}
		
		$orgs = $this->Event->Pool->Team->User->Org->Staff->findAll(array('User.id' => $this->othAuth->user('id')));
		
		$teams = $this->Event->Pool->Team->find('list');
		$games = $this->Event->Game->find('list');
		$eventtypes = $this->Event->Eventtype->find('list');
		$this->set(compact('teams', 'games', 'eventtypes', 'orgs'));
		
	}
	

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Event', true), array('action'=>'index'));
		}
		if ($this->Event->del($id)) {
			$this->flash(__('Event deleted', true), array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Event->recursive = 0;
		$this->set('events', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Event', true), array('action'=>'index'));
		}
		$this->set('event', $this->Event->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Event->create();
			if ($this->Event->save($this->data)) {
				$this->flash(__('Event saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		$teams = $this->Event->Pool->Team->find('list');
		$games = $this->Event->Game->find('list');
		$eventtypes = $this->Event->Eventtype->find('list');
		$this->set(compact('teams', 'games', 'eventtypes'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Event', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Event->save($this->data)) {
				$this->flash(__('The Event has been saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Event->read(null, $id);
		}
		$teams = $this->Event->Pool->Team->find('list', array( 'order' => 'name ASC'));
		$games = $this->Event->Game->find('list');
		$eventtypes = $this->Event->Eventtype->find('list');
		$this->set(compact('teams','games','eventtypes'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Event', true), array('action'=>'index'));
		}
		if ($this->Event->del($id)) {
			$this->flash(__('Event deleted', true), array('action'=>'index'));
		}
	}

}
?>