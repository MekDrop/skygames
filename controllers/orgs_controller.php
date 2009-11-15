<?php
class OrgsController extends AppController {

	var $name = 'Orgs';
	var $helpers = array('Html', 'Form', 'Javascript', 'Ajax');	
	var $components = array('Upload');
	
	function invite($id = null)
	{
		$ident = array("Staff.user_id" => $this->othAuth->user('id'), "Staff.org_id"=> $id, "Staff.position"=>"headadmin");
		$userRecord = $this->Org->Staff->findAll($ident);

		/*
		if ($id)
			$org = $this->Org->read(null, $id);
		*/
		
		if (!$userRecord && $org['User']['id'] != $this->othAuth->user('id'))
		{
			$this->Session->setFlash(__('Unexpected error', true));
			$this->redirect('/');
			exit();	
		}
		
		if (!empty($this->data)) 
		{
			$users = $this->Org->User->findAll(array('username'=>$this->data["Org"]['user_name']));					
			
			if (count($users) == 1)
			{								
				$this->Org->Staff->create();
				$teamMembers = array ('Staff'=>array ('org_id'=>$id, 'user_id'=>$users[0]['User']['id']));
				if ($this->Org->Staff->save( $teamMembers ))
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
		
		$this->set('org_id', $id);	
		
	}
	
	function promote($org_id = null, $user_id = null, $position = 'admin')
	{
		//	Check users rights to promote

		if ($org_id)
			$org = $this->Org->read(null, $org_id);		
		
		if ($org['User']['id'] == $user_id)
		{
			$this->Session->setFlash(__('Unexpected error', true));
			$this->redirect('/');
			exit();	
		}
		
		$ident = array("Staff.user_id" => $this->othAuth->user('id'), "Staff.org_id" => $org_id, "Staff.position" => "headadmin");
		$userRecord = $this->Org->Staff->findCount($ident);
		
		if (!$userRecord)
		{
			$this->Session->setFlash(__('Unexpected error', true));
			$this->redirect('/');
			exit();	
		}
							
		if ($this->Org->Staff->updateAll(array('position' => "'".$position."'"), array ('Staff.org_id' => $org_id, 'Staff.user_id' => $user_id)))
		{
			$this->Session->setFlash(__('User has been promoted/demoted.', true));
			$this->redirect(array('controller' => 'orgs', 'action'=>'edit', $org_id));	
			exit();
		}		
		else
		{
			$this->Session->setFlash(__('Unexpected error', true));
			$this->redirect(array('controller' => 'orgs', 'action'=>'edit', $org_id));
			exit();		
		}	
	
		
		
		$this->set('org_id', $org_id);	
		
	}
	
	function uninvite($org_id = null, $user_id = null)
	{
		if ($org_id)
			$org = $this->Org->read(null, $org_id);		
		
		if ($org['User']['id'] == $user_id)
		{
			$this->Session->setFlash(__('Unexpected error', true));
			$this->redirect('/');
			exit();	
		}
		
		$ident = array("Staff.user_id"=>$this->othAuth->user("id"), "Staff.org_id"=> $org_id, "Staff.position"=>"headadmin");
		$userRecord = $this->Org->Staff->findAll($ident);

		if (!$userRecord)
		{
			$this->Session->setFlash(__('Unexpected error', true));
			$this->redirect('/');
			exit();	
		}
		
		if ($org_id && $user_id) 
		{
			
			if ($this->Org->Staff->deleteAll(array("Staff.user_id"=>$user_id, "Staff.org_id"=>$org_id)))
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
			$ident = array("Staff.user_id"=>$this->othAuth->user("id"), "Staff.org_id"=>$id, "Staff.status"=>"invited");
			$invitedUsers = $this->Org->Staff->findAll($ident);		
			if (!empty($invitedUsers))
			{	
				
				if ($this->Org->Staff->updateAll(array("status" => '\'member\''), $ident))				
					$this->Session->setFlash(__("You have joined the team", true));				
				else
					$this->Session->setFlash(__("Error has occured", true));
				
				
				$this->Org->User->Group->unbindAll();
				$organizationGroup = $this->Org->User->Group->find(array("name" => "organizations"), array ("id"));
					
				$this->Org->User->updateAll(array("group_id" => $organizationGroup['Group']['id']), array("User.id" => $this->othAuth->user("id")) );
					
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
		$this->Org->recursive = 0;
		$this->set('orgs', $this->paginate());
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Team', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		
		if (!empty($this->data)) {
			//	So, we can't change team type afterwards
			$type = $this->data["Org"]["type"];
			unset($this->data["Org"]['type']);
			if ($this->Org->save($this->data)) {
				$this->Session->setFlash(__('The Team has been saved', true));
				$this->redirect(array('action'=>'edit', $id));
			} else {
				$this->Session->setFlash(__('The Team could not be saved. Please, try again.', true));
				$this->data["Org"]["type"]	= $type;	
			}
			
			$team = $this->data;
			$this->data = $this->Org->read(null, $id);
			$this->data["Org"] = $team["Org"];
		}
		
		if (empty($this->data)) {
			
			$this->data = $this->Org->read(null, $id);
		}
		

		/*
		$userOrgs = $this->Org->findAll(array('user_id' => $this->othAuth->user('id')));
		$this->set('userOrgs', $userOrgs);
		*/
		
		$this->Org->Staff->recursive = 2;
		$this->Org->Staff->unbindModel(array('belongsTo'=>  array('Team')));
		$this->Org->Staff->User->unbindModel(array('belongsTo' => array('Group'), 'hasMany' => array('Team'), 'hasAndBelongsToMany' => array('Clan')));		
		$members = $this->Org->Staff->findAll(array('Staff.org_id'=>$id));
		$this->set('members', $members);
		$this->set('org', $this->data["Org"]);		
		$this->titleForContent =  '<b>' . $this->data["Org"]['name'] . '</b>';
		
		//$this->contentHelpers[] = array("name" => "userteams", "cachetime" => array("cache" => "1 hour"));
		//$this->contentHelpers = array("0" => array('name'=>'feeds', 'cachetime' => array('cache'=>'1 hour')), "1" => array('name'=>'userteams', 'cachetime' => array('cache'=>'1 hour')));
	}
	
	/*
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Org', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Org->save($this->data)) {
				$this->Session->setFlash(__('The Org has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Org could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Org->read(null, $id);
		}
		$staffs = $this->Org->Staff->find('list');
		$users = $this->Org->User->find('list');
		$this->set(compact('staffs','users'));
	}
	*/

	function upload() {

		if (empty($this->data)) {
			return false;
		} else {	
			
			$id = $this->data['Org']['id'];
	
			// set the upload destination folder
			$destination = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS . 'img' . DS . 'uploads' . DS . 'logos' . DS;
	
			// grab the file
			$file = $this->data['Org']['logo_file'];
	
			// upload the image using the upload component
			$result = $this->Upload->upload($file, $destination, null, array('type' => 'resizecrop', 'size' => array('234', '60'), 'output' => 'jpg', 'quality' => '100'));
			
			if (!$result)
			{
				$this->data['Org']['logo_url'] = '/v2/img/uploads/logos/' . $this->Upload->result;
				
				
				if ($this->Org->save($this->data, false)) 
				{
					$this->Session->setFlash(__('The Image has been uploaded', true));		
					$this->redirect(array('controller'=>'orgs','action'=>'edit', $id));
					exit();
				} 
				else 
				{				
					$this->Session->setFlash((__('Could\'nt upload the image', true)));		
					$this->redirect(array('controller'=>'orgs','action'=>'edit', $id));		
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
				$this->redirect(array('controller'=>'orgs','action'=>'edit', $id));
				exit();
			}
			
		
		}
	}	

	function admin_index() {
		$this->Org->recursive = 0;
		$this->set('orgs', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Org.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('org', $this->Org->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Org->create();
			if ($this->Org->save($this->data)) {
				$this->Session->setFlash(__('The Org has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Org could not be saved. Please, try again.', true));
			}
		}
		$staffs = $this->Org->Staff->find('list');
		$users = $this->Org->User->find('list');
		$this->set(compact('staffs', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Org', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Org->save($this->data)) {
				$this->Session->setFlash(__('The Org has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Org could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Org->read(null, $id);
		}
		$staffs = $this->Org->Staff->find('list');
		$users = $this->Org->User->find('list');
		$this->set(compact('staffs','users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Org', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Org->del($id)) {
			$this->Session->setFlash(__('Org deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>