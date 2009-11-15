<?php
class MatchesController extends AppController {

	var $name = 'Matches';
	
	
	var $uses = array ('Match', 'Staff');
	var $helpers = array('Html', 'Form', 'OthAuth', 'Paginator', 'Ajax', 'Javascript', 'Session');	
	var $paginate = array('Matchcomment' => array('limit' => 8, 'page' => 'last'));
	

	var $cacheAction = array(
	 'latest/' => '10 minutes',
	);

	function index() {
		$this->Match->recursive = 0;
		$this->set('matches', $this->paginate());
	}

	
	function view($id = null) {
		
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid Match.', true));
			$this->redirect(array('action'=>'index'));
		}				
		
		$this->Match->bindModel(array('hasMany'=>array (		
			'Matchcomment' => array('className' => 'Matchcomment',
								'foreignKey' => 'match_id',
							
			)
		)));		
		
		
		
		
		
		$match = $this->Match->read(null, $id);
		$results = $this->Match->Result->findAll(array('match_id' => $id));
		$comments = $this->paginate('Matchcomment', array('match_id' => $id));
		$team1 = $this->Match->Team1->read(null, $match["Team1"]["id"]);
		$team2 = $this->Match->Team2->read(null, $match["Team2"]["id"]);
		
		$userIsAdmin = $this->Staff->findCount(array ('Staff.user_id' => $this->othAuth->user('id'), 'Staff.org_id' => $match['Event']['org_id'])) || $this->othAuth->group("level") >= 300;
		
		if (!empty($team1["Teamplayer"]))
			$players1 = $team1["Teamplayer"];
		else
			$players1 = $team1["Member"];

		if (!empty($team2["Teamplayer"]))
			$players2 = $team2["Teamplayer"];
		else
			$players2 = $team2["Member"];
			
			
		$this->set('comments', $comments);
		$this->set('results', $results);		
		$this->set('match', $match);
		$this->set('players1', $players1);
		$this->set('players2', $players2);
		
		$this->set('userIsAdmin', $userIsAdmin);
		
		$this->titleForContent = __("Match", true) . ' <b>' . $match["Team1"]["name"] . '</b>' . ' vs ' . '<b>' . $match["Team2"]["name"] .  '</b> (' . $match["Event"]["name"] . ')';
	}

	function latest()
	{
		$this->Event->recursive = 0;

		$matches = $this->Match->findAll(null, null, 'Match.modified DESC, Match.id DESC', 6);
		if(isset($this->params['requested'])) {		 	 
             return $matches;
        } 
		else
		$this->set('matches', $matches);
	}
	
	function comments()
	{
		$this->layout = 'ajax';
		Configure::write('debug', '0');
		
		$results = $this->Match->Result->findAll(array('match_id'=>$id));
		$this->set('comments', $comments);
	}
	
	function add($event_id = 0) {
		
		$this->layout = 'popup';
		Configure::write('debug', '0');		
		
		if (!$event_id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Match', true));
			//$this->redirect(array('action'=>'index'));
		}
		
		if (!empty($this->data)) {
			$this->Match->create();
			
			if (!isset($this->data["Match"]["date"]))
			{
				$this->data["Match"]["date"]["year"]= "";
				$this->data["Match"]["date"]["month"]= "";
				$this->data["Match"]["date"]["day"]= "";
				$this->data["Match"]["date"]["hour"] = "";
				$this->data["Match"]["date"]["min"] = "";
			}
			
			if ($this->Match->save($this->data)) {
				$this->Session->setFlash(__('The Match has been saved', true));
			} else {
				$this->Session->setFlash(__('The Match could not be saved. Please, try again.', true));
			}
			
			$this->render ('close');					
		}
		else
		{
			$teamsNested = $this->Match->Team1->Eventteam->findAll(array ('Eventteam.event_id' => $event_id), array ('id' => 'Team.id', 'name' => 'Team.name'));
			
			foreach ($teamsNested as $t)
				$team1s[$t['Team']['id']] = $t['Team']['name'];		
						
			$team2s = $team1s;
			
			$playofftables = $this->Match->Playofftable->find('list', array ('conditions' => array ('events_id' => $event_id)));
			$grouptables = $this->Match->Grouptable->find('list', array ('conditions' => array ('Grouptable.event_id' => $event_id)));
			
			$this->set(compact('team1s','team2s','playofftables', 'grouptables'));
			$this->set('event_id', $event_id);
			
			$this->titleForContent =  __("Match for", true).' <b>' . $this->data["Event"]["name"] . '</b>';
		}

	}

	function edit($id = null) {
		
		$this->layout = 'popup';
		Configure::write('debug', '0');
		//$this->view = 'edit';
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Match', true));
			//$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if (!isset($this->data["Match"]["date"]))
			{
				$this->data["Match"]["date"]["year"]= "";
				$this->data["Match"]["date"]["month"]= "";
				$this->data["Match"]["date"]["day"]= "";
				$this->data["Match"]["date"]["hour"] = "";
				$this->data["Match"]["date"]["min"] = "";
			}
			
			if ($this->Match->save($this->data)) {
				$this->Session->setFlash(__('The Match has been saved', true));
				//$this->redirect(array('controller'=>'matches','action'=>'view', $id));
			} else {
				$this->Session->setFlash(__('The Match could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Match->read(null, $id);
		}
		
		$teamsNested = $this->Match->Team1->Eventteam->findAll(array ('Eventteam.event_id' => $this->data["Match"]["event_id"]), array ('id' => 'Team.id', 'name' => 'Team.name'));
		
		foreach ($teamsNested as $t)
			$team1s[$t['Team']['id']] = $t['Team']['name'];		
					
		//$team1s = $this->Match->Team1->findAllHabtm(array('Event.id' => $this->data["Match"]["event_id"]));
		$team2s = $team1s;
		
		$playofftables = $this->Match->Playofftable->find('list', array ('conditions' => array ('events_id' => $this->data["Match"]["event_id"])));
		$grouptables = $this->Match->Grouptable->find('list', array ('conditions' => array ('Grouptable.event_id' => $this->data["Match"]["event_id"])));
		
		$this->set(compact('team1s','team2s','playofftables', 'grouptables'));
		
		$this->titleForContent =  __("Match for", true).' <b>' . $this->data["Event"]["name"] . '</b>';
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Match', true));
			//$this->redirect(array('action'=>'index'));
			$this->redirect($this->referer(null, true));
		}
		if ($this->Match->del($id)) {
			$this->Session->setFlash(__('Match deleted', true));
			$this->redirect($this->referer(null, true));
			//$this->redirect(array('action'=>'index'));
		}
	}

	function addcomment()
	{
		if (!empty($this->data)) {
			$this->data['Matchcomment']['user_id'] = $this->othAuth->user('id');
			//$this->data['Matchcomment'] = $this->data['Match'];
			//unset($this->data['Match']);
			$this->Match->Matchcomment->create();
			if ($this->Match->Matchcomment->save($this->data)) {
				$this->Session->setFlash(__('Comment has been submited', true));		
				$this->redirect(array('action'=>'view', $this->data['Matchcomment']['match_id']));										
				exit();
			} else {
				$this->Session->setFlash(__('Error occured', true));
				$this->redirect(array('action'=>'view', $this->data['Matchcomment']['match_id']));										
				exit();
			}
		}		
	}

	function admin_index() {
		$this->Match->recursive = 0;
		$this->set('matches', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Match.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('match', $this->Match->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Match->create();
			if ($this->Match->save($this->data)) {
				$this->Session->setFlash(__('The Match has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Match could not be saved. Please, try again.', true));
			}
		}
		$events = $this->Match->Event->find('list');
		$team1s = $this->Match->Team1->find('list');
		$team2s = $this->Match->Team2->find('list');
		$playofftables = $this->Match->Playofftable->find('list');
		$this->set(compact('events', 'team1s', 'team2s', 'playofftables'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Match', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Match->save($this->data)) {
				$this->Session->setFlash(__('The Match has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Match could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Match->read(null, $id);
		}
		$events = $this->Match->Event->find('list');
		$team1s = $this->Match->Team1->find('list');
		$team2s = $this->Match->Team2->find('list');
		$playofftables = $this->Match->Playofftable->find('list');
		$this->set(compact('events','team1s','team2s','playofftables'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Match', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Match->del($id)) {
			$this->Session->setFlash(__('Match deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>