<?php
class BettsController extends AppController {

	var $name = 'Betts';
	var $helpers = array('Html', 'Form');
	var $uses = array ('Bett', 'Awardbett');

	/**
	 * @var Model
	*/
	var $Bett, $Awardbett;
	
	function latest($match_id = 0)
	{
		if ($match_id == 0)
		return false;
			
		$infos = $this->Bett->findAll(array("match_id" => $match_id), null, 'Bett.created DESC', 5);
		if(isset($this->params['requested'])) {
			return $infos;
		}
		else
		$this->set('infos', $infos);
	}


	function add() {
		if (!empty($this->data)) {
			$this->data['Bett']['user_id'] = $this->othAuth->user('id');
				
			//	Perform user point check
			$this->Bett->User->recursive = -1;
			$user = $this->Bett->User->read(null, $this->othAuth->user('id'));
				
				
			if ($this->data['Bett']['sum'] > $user['User']['points'])
			{
				$this->Session->setFlash(__('You dont have enough points.', true));
				$this->redirect(array('controller' => 'matches', 'action'=>'view', $this->data['Bett']['match_id']));
				exit();
			}
				
			$this->Bett->create();
			if ($this->Bett->save($this->data)) {
				$this->Bett->User->updateAll(array ('User.points' => $user['User']['points'] - $this->data['Bett']['sum']), array ('User.id' => $this->othAuth->user('id')));
				$this->Session->setFlash(__('The Bett has been saved', true));
			} else {
				$this->Session->setFlash(__('The Bett could not be saved. Please, try again.', true));
			}
			$this->redirect(array('controller' => 'matches', 'action'=>'view', $this->data['Bett']['match_id']));
			exit();
		}

		if ($id == null)
		$this->redirect(array('controller' => 'infos', 'action'=>'i', $this->data['Bett']['match_id']));
		else
		$this->redirect(array('controller' => 'matches', 'action'=>'view', $this->data['Bett']['match_id']));

		exit();

	}
	
	function addawardbett() {
		
	
		
		if (!empty($this->data)) {
			$this->data['Awardbett']['user_id'] = $this->othAuth->user('id');
				
			//	Perform user point check
			$this->Bett->User->recursive = -1;
			$user = $this->Bett->User->read(null, $this->othAuth->user('id'));

		
			if ($this->data['Awardbett']['sum'] > $user['User']['points'])
			{
				$this->Session->setFlash(__('You dont have enough points.', true));
				$this->redirect(array('controller' => 'events', 'action'=>'view', $this->data['Awardbett']['event_id']));
				exit();
			}
				
			$this->Awardbett->create();
			if ($this->Awardbett->save($this->data)) {
				$this->Bett->User->updateAll(array ('User.points' => $user['User']['points'] - $this->data['Awardbett']['sum']), array ('User.id' => $this->othAuth->user('id')));
				$this->Session->setFlash(__('The Bett has been saved', true));
			} else {
				$this->Session->setFlash(__('The Bett could not be saved. Please, try again.', true));
			}
			$this->redirect(array('controller' => 'events', 'action'=>'view', $this->data['Awardbett']['event_id']));
			exit();
		}

		if ($id == null)
			$this->redirect(array('controller' => 'infos', 'action'=>'i', $this->data['Awardbett']['match_id']));
		else
			$this->redirect(array('controller' => 'events', 'action'=>'view', $this->data['Awardbett']['event_id']));

		exit();

	}


	function admin_index() {
		$this->Bett->recursive = 0;
		$this->set('betts', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Bett.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('bett', $this->Bett->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Bett->create();
			if ($this->Bett->save($this->data)) {
				$this->Session->setFlash(__('The Bett has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Bett could not be saved. Please, try again.', true));
			}
		}
		$matches = $this->Bett->Match->find('list');
		$teams = $this->Bett->Team->find('list');
		$users = $this->Bett->User->find('list');
		$this->set(compact('matches', 'teams', 'users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Bett', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Bett->save($this->data)) {
				$this->Session->setFlash(__('The Bett has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Bett could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Bett->read(null, $id);
		}
		$matches = $this->Bett->Match->find('list');
		$teams = $this->Bett->Team->find('list');
		$users = $this->Bett->User->find('list');
		$this->set(compact('matches','teams','users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Bett', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Bett->del($id)) {
			$this->Session->setFlash(__('Bett deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>