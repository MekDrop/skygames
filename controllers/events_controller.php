<?php
class EventsController extends AppController {

	var $name = 'Events';
	
	var $helpers = array('Html', 'Form', 'Session', 'Javascript', 'Ajax');		
	//var $uses = array('Team');
	
	function afterFilter()
	{
		
		
	}
	
	function index() {
		
		$this->Event->recursive = 0;		

		$conditions = array();
		
		if (!empty($this->data['Event']['game_id']))
			$conditions['game_id'] = $this->data['Event']['game_id'];
		elseif (!empty($this->params['named']['game_id']))
		{
			$this->data['Event']['game_id'] = $this->params['named']['game_id'];
			$conditions['game_id'] = $this->params['named']['game_id'];
		}

		if (!empty($this->data['Event']['org_id']))
			$conditions['org_id'] = $this->data['Event']['org_id'];
		elseif (!empty($this->params['named']['org_id']))
		{
			$this->data['Event']['org_id'] = $this->params['named']['org_id'];
			$conditions['org_id'] = $this->params['named']['org_id'];
		}			
		
		if (!empty($conditions))		
			$this->paginate = array('Event' => array('limit' => 7, 'page' => 'first', 'order' => 'Event.created DESC', 'conditions' =>  $conditions));
		else
			$this->paginate = array('Event' => array('limit' => 7, 'page' => 'first', 'order' => 'Event.created DESC'));
		
		$events = $this->paginate();

		$orgs = $this->Event->Team->User->Org->find('list');
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
			$teams = $this->Event->Team->findAll(array('user_id' => $this->othAuth->user('id'), 'game_id' => $event['Event']['game_id']));
			
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
				$this->Event->Team->create();
				$soloTeam["Team"] = array ("user_id" => $this->othAuth->user('id'), "name" => $this->othAuth->user('username'), "tag" => $this->othAuth->user('username'), "type" => "solo", "game_id" => $event['Event']['game_id']);

				if (!$this->Event->Team->save($soloTeam))
				{
					$this->Session->setFlash(__('Error has occured while trying to create solo team', true));		
					$this->redirect(array('controller'=>'teams','action'=>'add',$this->othAuth->user('id')));								
				}
				
				$soloTeamId = $this->Event->Team->getLastInsertID();
			} 
			
			$this->redirect(array('action'=>'sign', $id, $soloTeamId));
			exit();
		}
		else
		{
			$teams = $this->Event->Team->findAll(array('user_id' => $this->othAuth->user('id'), 'game_id' => $event['Event']['game_id'], 'type' => '!=solo'));
			
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
		
		if ($team_id == null && isset($this->data["Team"]["name"]))
		{
			$team = $this->Event->Team->find(array("name" => $this->data["Team"]["name"]), array("id"), null, -1);
			$team_id = $team['Team']['id'];
		}	

		if ($id == null && isset($this->data["Event"]["id"]))
			$id = $this->data["Event"]["id"];			
		
		//	check ok
		if (!$id) {		
			$this->Session->setFlash(__('You can\'t signup for this event', true));		
			$this->redirect(array('action'=>'index'));
			exit();
		}	
		
		
		$appedCount = $this->Event->Eventteam->findCount(array('event_id'=>$id, 'level' => 'A'));
		$event = $this->Event->read(null, $id);
		
		
		if ($event["Event"]["teamcount"] <= $appedCount)
		{		
			$this->Session->setFlash(__('The event is full', true));		
			$this->redirect(array('controller'=>'events','action'=>'view', $id));
			exit();
		}			
		
		//	team chosen
		if ($team_id)
		{
			$myTeam = $this->Event->Team->read(null, $team_id);
			
			$signed = false;
			foreach ($myTeam['Event'] as $event)
				if ($event['id'] == $id) $signed = true;
				
			if ($signed)	
			{		
				$this->Session->setFlash(__('The team is already signed', true));		
				$this->redirect(array('controller'=>'events','action'=>'view', $id));
				exit();
			}	
				
			$userIsAdmin = $this->othAuth->group("level") >= 300 || $this->Event->User->Staff->findCount(array ('Staff.user_id' => $this->othAuth->user('id'), 'Staff.org_id' => $event['Event']['org_id']));			
				
			//	have permision
			if (!empty($myTeam) && ($myTeam['Team']['user_id'] == $this->othAuth->user('id') || $userIsAdmin))
			{
				
				//	validate
				
				
								
				//	save															
				$myTeam['Event'][] = $id;					
				if ($this->Event->Team->save($myTeam, false))					
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
		
		if ($this->Event->Eventteam->deleteAll(array("event_id"=>$id, "team_id"=>$team_id))) {
			$this->flash(__('Team kicked', true), true);
			$this->redirect(array('action'=>'index'));
			
		}
	}
	
	function approve($id = null, $team_id = null)
	{
		if (!$id) {
			$this->flash(__('Invalid Event', true), array('action'=>'index'));
		}
				
				
		$ident = array('Eventteam.event_id'=>$id, 'Eventteam.team_id'=>$team_id);
		$signedTeam = $this->Event->Eventteam->findCount($ident);
		
		if (!empty($signedTeam))
		{

			if ($this->Event->Eventteam->updateAll(array('level'=>'\'A\''), $ident))
			{		
				//	Check if we are good to go
				$cnt = $this->Event->Eventteam->findCount(array("event_id"=>$id, "level"=>"A"));
				$teams = $this->Event->Eventteam->findAll(array("event_id"=>$id, "level"=>"A"));			
				$event = $this->Event->read(null, $id);	
					
				if ($event["Event"]["teamcount"] == $cnt && !$event["Event"]["startdate"])
				{
					
					if ($event["Event"]["status"] == "signup" && !$event['Eventtype']['groups'])
					{
						$table = $this->Event->Playofftable->find(array("Playofftable.name"=>$event["Event"]["name"]));
						if ($table)
						{
							$this->generateInitialMatches($id, $table["Playofftable"]["id"], $teams);
						}
					}
					elseif ($event["Event"]["status"] == "signup" && $event['Eventtype']['groups'])
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
				
		//$this->Event->Match->unbindModel(array('hasMany' => array('Matchcomment')));
		
		//$this->Event->Match->restrict('Result'); 		
		$matches = $this->Event->Match->findAll(array('Match.event_id'=>$id));
		
		//$playofftables = $this->Event->Playofftable->findAll(array('events_id'=>$id));		
		$groups = $this->Event->Grouptable->findAll( array('event_id'=>$id) );
		
		$groupMatchesVsResults = $this->Event->query("SELECT count(matches.id) matchCount, count(results.id) resultCount FROM matches
														LEFT JOIN results ON results.match_id = matches.id AND results.matchpart_id = 1
														JOIN grouptables ON matches.grouptable_id = grouptables.id
														WHERE grouptables.event_id = " . $id);
		
		if (($groupMatchesVsResults['0']['0']['matchCount'] == $groupMatchesVsResults['0']['0']['resultCount']) and ($groupMatchesVsResults['0']['0']['resultCount'] == count($matches))) 
			$canStartPlayoff = true;
		else
			$canStartPlayoff = false;		
		
		//foreach ($playofftables as $table)
		//	$areBigTables = ($areBigTables || ($table['Playofftable']['type'] == 'D' && $table['Playofftable']['size'] >= 8) ? $areBigTables = true : $areBigTables = false);

		//$this->Event->Team->unbindModel(array('hasMany'=>array('Teamplayer'),'hasAndBelongsToMany'=>array('Event')));
		//$teams = $this->Event->Team->unbindModel();
		$teams = $this->Event->Team->findAllHabtm(array('Event.id' => $id));
		
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
		
		//$teams = false;

		//$teams = $event['Team'];
		
		//$teams = $this->Event->Team->findAll(array('Event.id' => $id));
		//$teams = $this->Event->Team->query(array('Event.id' => $id));	

		
		$this->set('event', $event);
		$this->set('matches', $matches);
		$this->set('teams', $teams);
		$this->set('groups', $groups);
		$this->set('userIsAdmin', $userIsAdmin);
		$this->set('userCanStartPlayoff', $canStartPlayoff);		
		
		
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
			//$team
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
		$cnt = $this->Event->Eventteam->findCount(array("event_id"=>$id, "level"=>"A"));	
		$teams = $this->Event->Eventteam->findAll(array("event_id"=>$id, "level"=>"A")); 	
		$event = $this->Event->read(null, $id);	
			
		if ($event["Event"]["teamcount"] == $cnt && $event["Event"]["teamcount"])
		{								
			if ($this->Event->updateAll(array("status"=>'"active"'), array("Event.id" => $id)))
			//if ($this->Event->updateAll(array("status"=>'"active"', "startdate" => date("Y-m-d h:m:00")), array("Event.id" => $id)))
			{
				$table = $this->Event->Playofftable->find(array("Playofftable.name" => $event["Event"]["name"]));				
				$groups = $this->Event->Grouptable->findAll(array("Grouptable.event_id" => $event["Event"]["id"]));
				
				//	Start event w/o groups
				if ($event["Event"]["status"] == "signup" && !$event['Eventtype']['groups'] && $table)
				{
					$this->generateInitialMatchesElminitation($id, $table["Playofftable"]["id"], $teams);									
					{
						$this->Session->setFlash(__('Event started. Table generated.', true));							
					}
				}	
				//	Start event with groups
				elseif ($event["Event"]["status"] == "signup" && $event['Eventtype']['groups'] && $groups)
				{										
					$this->generateInitialMatchesGroups($id, $groups, $teams, $event['Event']['grouprounds']);									
					{
						$this->Session->setFlash(__('Event started. Groups generated.', true));							
					}					
				}						
				//	
				else
				{
					$this->Session->setFlash(__('Event started.', true) . " " . __('Matches not generated - bad status', true));											
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
		
		if ($this->Event->updateAll(array("status"=>'"closed"'), array("Event.id" => $id)))
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

		if ($this->Event->updateAll(array("status"=>'"finished"'), array("Event.id" => $id)))
			{
				$this->Session->setFlash(__('Event finished', true));	
				$this->redirect(array('action'=>'view', $id));
		}			
	}
	
	
	function add() {
		if (!empty($this->data)) {
			$this->data['Event']['user_id'] = $this->othAuth->user('id');
			
			$this->Event->create();						
			if ($this->Event->save($this->data)) {
				
				$eve = $this->Event->getLastInsertID();
				if ($this->data["Event"]["create_ptable"] != null)
				{
					$playofftable["Playofftable"] = array ("name" => $this->data["Event"]["name"], "type" => $this->data["Event"]["table_type"], 
														   "type" => $this->data["Event"]["table_theme"],
														   "events_id" => $eve, "size" => $this->data["Event"]["teamcount"]);
					$this->Event->Playofftable->create();	
					$this->Event->Playofftable->save($playofftable);
				
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
		
		$orgs = $this->Event->Team->User->Org->Staff->findAll(array('User.id' => $this->othAuth->user('id')));
		
		$teams = $this->Event->Team->find('list');
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
		$teams = $this->Event->Team->find('list');
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
		$teams = $this->Event->Team->find('list', array( 'order' => 'name ASC'));
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