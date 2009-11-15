<?php
class TeamplayersController extends AppController {

	var $name = 'Teamplayers';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Teamplayer->recursive = 0;
		$this->set('teamplayers', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Teamplayer', true), array('action'=>'index'));
		}
		$this->set('teamplayer', $this->Teamplayer->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Teamplayer->create();
			if (!$this->data['Teamplayer']['uniqueid'])
				unset($this->data['Teamplayer']['uniqueid']);			
		
			if ($this->Teamplayer->save($this->data)) {	
				$this->Session->setFlash(__('Teamplayer saved', true));			
				$this->redirect(array('controller'=>'teams','action'=>'edit', $this->Teamplayer->field('team_id')) );
				exit();
			} else {
				$this->Session->setFlash(__('The player could not be saved. Please, try again.', true));			
				$this->redirect($this->referer(null, true));
				exit();
			}
		}
		$teams = $this->Teamplayer->Team->find('list');
		$this->set(compact('teams'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Teamplayer', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Teamplayer->save($this->data)) {				
				$this->Session->setFlash(__('The Teamplayer has been saved', true));			
				$this->redirect(array('controller'=>'teams','action'=>'edit', $this->Teamplayer->field('team_id')) );
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Teamplayer->read(null, $id);
		}
		$teams = $this->Teamplayer->Team->find('list');
		$this->set(compact('teams'));
		
		$this->titleForContent = $this->data['Teamplayer']['name'];
	}

	function delete($id = null, $team_id = null) {
		if (!$id) {
			$this->flash(__('Invalid Teamplayer', true), array('action'=>'index'));
		}
		if ($this->Teamplayer->del($id)) {			
			$this->Session->setFlash(__('Teamplayer deleted', true));		
			$this->redirect(array('controller'=>'teams','action'=>'edit', $team_id));
		}
	}


	function admin_index() {
		$this->Teamplayer->recursive = 0;
		$this->set('teamplayers', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Teamplayer', true), array('action'=>'index'));
		}
		$this->set('teamplayer', $this->Teamplayer->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Teamplayer->create();
			if ($this->Teamplayer->save($this->data)) {
				$this->flash(__('Teamplayer saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		$teams = $this->Teamplayer->Team->find('list');
		$this->set(compact('teams'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Teamplayer', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Teamplayer->save($this->data)) {
				$this->flash(__('The Teamplayer has been saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Teamplayer->read(null, $id);
		}
		$teams = $this->Teamplayer->Team->find('list');
		$this->set(compact('teams'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Teamplayer', true), array('action'=>'index'));
		}
		if ($this->Teamplayer->del($id)) {
			$this->flash(__('Teamplayer deleted', true), array('action'=>'index'));
		}
	}

}
?>