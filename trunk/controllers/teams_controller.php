<?php
class TeamsController extends AppController {
	

	var $name = 'Teams';
		
	var $helpers = array('Html', 'Form', 'Javascript', 'Ajax');	
	var $paginate = array('order' => 'Team.name'); 
	var $uses = array('Team', 'User');
	var $components = array('Upload');

	function autocomplete($game_id, $type = null)
	{
		Configure::write('debug', '0');
				
		$conditions = array("name LIKE '%" . $this->data['Team']['name'] . "%'");
		$conditions[]["game_id"] = $game_id;
		if ($type != null)
			$conditions[]["type"] = $type;
    	$teams = $this->Team->findAll($conditions, array('name','id'), 'name ASC', 20, null, -1);    	
    	$this->set('teams', $teams);
    	
    } 
	
	function invite($id = null)
	{
	
		
		if (!empty($this->data)) 
		{
			$users = $this->Team->User->findAll(array('username'=>$this->data['Team']['user_name']));
			$team = $this->Team->read(null, $id);			
			
			if (count($users) == 1)
			{								
				$this->Team->Membership->create();
				$teamMembers = array ('Membership'=>array ('team_id'=>$id, 'user_id'=>$users[0]['User']['id']));
				if ($this->Team->Membership->save( $teamMembers ))
				{
					$this->Session->setFlash(__('User has been invited. Wait till he accepts.', true));
					$this->redirect(array('action'=>'edit', $id));	
				}		
				else
				{
					$this->Session->setFlash(__('Unexpected error', true));
					$this->redirect(array('action'=>'edit', $id));		
				}	
			}
			else
			{
				$this->Session->setFlash(__('User not found', true));
				$this->redirect(array('action'=>'edit', $id));		
				
			}
		}
		
		$this->set('team_id', $id);	
		
	}
	
	function uninvite($team_id = null, $user_id = null)
	{
	
		
		if ($team_id && $user_id) 
		{
			
			if ($this->Team->Membership->deleteAll(array("Membership.user_id"=>$user_id, "Membership.team_id"=>$team_id)))
			{
				$this->Session->setFlash(__('Player deleted', true));				
			}
			else
			{
				$i = 0;
			
				$this->Session->setFlash(__('Unexpected error', true));
			}	
	
		}
		else
		{
			$this->Session->setFlash(__('Wrong team and/or user', true));		
		}
		
		$this->redirect($this->referer(null, true));
		exit();			
	
		
	}
	
	function join($id = null)
	{		
		if ($id == null) 
			$this->redirect('/');
		
		if ($id != null && $this->othAuth->user('id'))
		{						
			$ident = array('Membership.user_id'=>$this->othAuth->user('id'),'Membership.team_id'=>$id, 'Membership.status'=>'invited');
			$invitedUsers = $this->Team->Membership->findAll($ident);		
			if (!empty($invitedUsers))
			{	
				if ($this->Team->Membership->updateAll(array('status'=>'\'member\''), $ident))				
					$this->Session->setFlash(__('You have joined the team', true));				
				else
					$this->Session->setFlash(__('Error has occured', true));
					
				$this->redirect($this->referer(null, true));
				exit();
				
			}
			else
			{
				$this->Session->setFlash(__('You are not invited', true));
				$this->redirect(array('action'=>'view', $id));	
				exit();			
			}	

		}
		
	}
	
	function index() {
		$this->Team->recursive = 0;
		$this->set('teams', $this->paginate('Team', array("NOT" => array("type" => "solo"))));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Team.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$this->Team->bindModel(array('hasOne'=>array (		
			'Teamdetail' => array('className' => 'Teamdetail',
								'foreignKey' => 'team_id')
		)));
		
		$team = $this->Team->read(null, $id);
		$this->set('team', $team);
		
		if ($team['Team']['type'] == 'solo')
		{
			$this->redirect(array('controller'=>'users', 'action'=>'view', $team['Team']['user_id']));
		}

		//$this->Team->User->Membership->recursive = 2;				
		//$this->Team->User->Membership->unbindAll();
		//$this->Team->User->Membership->bindModel(array('belongsTo'=>array('User')));
		//$this->Team->User->unbindAll();
		//$this->Team->User->bindModel(array('hasMany'=>array('Uniqueid'), 'hasMany'=>array('Membership')));
		
		//$membership = $this->Team->User->Membership->findAll(array('team_id'=>$id));
		//$this->set('membership', $membership);
		
		$this->titleForContent = '<b>'.$team['Team']['name'].'</b>';
	}

	function add($id = null) {
		//	Check if user is trying to add team with user_id specified or we try to save team
		if ($id == null && empty($this->data)) 
			$this->redirect('/');
			
		if (!empty($this->data)) {
			//	Check if user_id supplied corresponds to user that is logged on			
			if ($this->data['Team']['user_id'] != $this->othAuth->user('id'))
				$this->redirect('/');
			
			$this->Team->create();
			if ($result = $this->Team->save($this->data)) {
				
				if ($this->data['Team']['addowner'] == '1')
				{
					if ($this->data['Team']['type'] == 'clan')
					{
						$this->Team->Membership->create();
						$teamMembers = array ('Membership'=>array ('team_id'=>$this->Team->getLastInsertId(), 'user_id'=>$this->othAuth->user('id'), 'status' => 'member'));
						if ($this->Team->Membership->save( $teamMembers ))
						{
							$this->Session->setFlash(__('The Team has been saved', true).'. '.__('Please add players to your team', true));
							$this->redirect(array('action'=>'edit', $this->Team->getLastInsertID()));
						}		
						else
						{
							$this->Session->setFlash(__('The Team has been saved', true).'. '.__('Error.', true));
							$this->redirect(array('action'=>'edit', $this->Team->getLastInsertID()));					
						}
					}		
					if ($this->data['Team']['type'] == 'mix')
					{						
						$uniqueid = $this->Team->User->Uniqueid->findAll(array("user_id" => $this->userId, "game_id" => $this->data['Team']['game_id']));
						if (!empty($uniqueid))
							$teamPlayer['uniqueid'] = $uniqueid[0]['Uniqueid']['value'];
						$teamPlayer['name'] = $this->othAuth->user('name');
						$teamPlayer['team_id'] = $this->Team->getLastInsertId();
						$this->Team->Teamplayer->create();
						if ($this->Team->Teamplayer->save( $teamPlayer ))
						{
							$this->Session->setFlash(__('The Team has been saved', true).'. '.__('Please add players to your team', true));
							$this->redirect(array('action'=>'edit', $this->Team->getInsertID()));
						}		
						else
						{
							$this->Session->setFlash(__('The Team has been saved', true));
							$this->redirect(array('action'=>'edit', $this->Team->getInsertID()));					
						}
					}						
				}
				else
				{
					$this->Session->setFlash(__('The Team has been saved', true).'. '.__('Please add players to your team', true));
					$this->redirect(array('action'=>'edit', $this->Team->getInsertID()));
				}
			} else {
				$this->Session->setFlash(__('The Team could not be saved. Please, try again.', true));
			}
		}
		$events = $this->Team->Event->find('list');		
		$games = $this->Team->Game->find('list');	
		$this->set(compact('events', 'users', 'games'));		
		$this->set('user', $this->Team->User->read(null, $id));
		$this->set('types', $this->Team->getEnumValues('type'));	
		
		$this->titleForContent = __('Add new team', true);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Team', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		
		if (!empty($this->data)) {
			//	So, we can't change team type afterwards
			$type = $this->data["Team"]["type"];
			unset($this->data['Team']['type']);
			if ($this->Team->save($this->data)) {
				$this->Session->setFlash(__('The Team has been saved', true));
				$this->redirect(array('action'=>'edit', $id));
			} else {
				$this->Session->setFlash(__('The Team could not be saved. Please, try again.', true));
				$this->data["Team"]["type"]	= $type;	
			}
			
			$team = $this->data;
			$this->data = $this->Team->read(null, $id);
			$this->data['Team'] = $team['Team'];
		}
		
		if (empty($this->data)) {
			
			$this->data = $this->Team->read(null, $id);
		}
		

		
		//$userTeams = $this->Team->findAll(array('user_id' => $this->othAuth->user('id')));
		//$this->set('userteams', $userTeams);
		
		$this->Team->Membership->recursive = 2;
		$this->Team->Membership->unbindModel(array('belongsTo'=>  array('Team')));
		$this->Team->Membership->User->unbindModel(array('belongsTo' => array('Group'), 'hasMany' => array('Team'), 'hasAndBelongsToMany' => array('Clan')));		
		$members = $this->Team->Membership->findAll(array('Membership.team_id'=>$id));
		$this->set('members', $members);
		$this->set('team', $this->data);
		$this->titleForContent =  '<b>' . $this->data['Team']['name'] . '</b>';
		
		//$this->contentHelpers[] = array("name" => "userteams", "cachetime" => array("cache" => "1 hour"));
		//$this->contentHelpers = array("0" => array('name'=>'feeds', 'cachetime' => array('cache'=>'1 hour')), "1" => array('name'=>'userteams', 'cachetime' => array('cache'=>'1 hour')));
	}

	function delete($id = null) {
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Team', true));
			$this->redirect(array('action'=>'index'));
		}
		else 
		{			
			$t = $this->Team->read(null, $id);
			if ($t['User']['id'] == $this->othAuth->user('id'))
			{		
				if ($this->Team->del($id)) {	
					
					$this->Session->setFlash(__('Team deleted', true));
					$this->redirect(array('action'=>'index'));
				}
			}
			else 
			{
				$this->Session->setFlash(__('Access denied', true));
				$this->redirect(array('action'=>'index'));								
			}
		}
	}

	function userteams() 
	{
	
		//if ($this->othAuth->sessionValid())
		//{
			$userTeams = $this->Team->findAll(array('user_id' => $this->othAuth->user('id')));
		    if( isset($this->params['requested']) )		 	 
            	return $userTeams;
      	//      } 
	  		else
	  			$this->set("userteams", $userTeams);
      
      return true;
		
		
	}

	function upload() {

		if (empty($this->data)) {
			return false;
		} else {	
			
			$id = $this->data['Team']['id'];
	
			// set the upload destination folder
			$destination = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS . 'img' . DS . 'uploads' . DS . 'logos' . DS;
	
			// grab the file
			$file = $this->data['Team']['logo_file'];
	
			// upload the image using the upload component
			$result = $this->Upload->upload($file, $destination, null, array('type' => 'resizecrop', 'size' => array('234', '60'), 'output' => 'jpg', 'quality' => '100'));
			
			if (!$result)
			{
				$this->data['Team']['logo_url'] = '/v2/img/uploads/logos/' . $this->Upload->result;
				
				
				if ($this->Team->save($this->data, false)) 
				{
					$this->Session->setFlash(__('The Image has been uploaded', true));		
					$this->redirect(array('controller'=>'teams','action'=>'edit', $id));
					exit();
				} 
				else 
				{				
					$this->Session->setFlash((__('Could\'nt upload the image', true)));		
					$this->redirect(array('controller'=>'teams','action'=>'edit', $id));		
					exit();
				}
					
			} 
			else 
			{
				// display error
				$errors = $this->Upload->errors;
	
				// piece together errors
				if(is_array($errors)){ $errors = implode(", ",$errors); }
	
				$this->Session->setFlash($errors);								
				$this->redirect(array('controller'=>'teams','action'=>'edit', $id));
				exit();
			}
			
		
		}
	}
	
	function admin_index() {
		$this->Team->recursive = 0;
		$this->set('teams', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Team.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('team', $this->Team->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Team->create();
			if ($this->Team->save($this->data)) {
				$this->Session->setFlash(__('The Team has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Team could not be saved. Please, try again.', true));
			}
		}
		$events = $this->Team->Event->find('list');
		$users = $this->Team->User->find('list');
		$games = $this->Team->Game->find('list');		
		$this->set('types', $this->Team->getEnumValues('type'));	
		$this->set(compact('events', 'users','games'));
	}

	function admin_edit($id = null) {
		
	
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Team', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Team->save($this->data)) {
				$this->Session->setFlash(__('The Team has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Team could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Team->read(null, $id);
		}
		$events = $this->Team->Event->find('list');
		$users = $this->Team->User->find('list');
		$games = $this->Team->Game->find('list');				
		$this->set(compact('events','users','games'));
		$this->set('types', $this->Team->getEnumValues('type'));		
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Team', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Team->del($id)) {
			$this->Session->setFlash(__('Team deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>