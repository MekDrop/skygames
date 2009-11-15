<?php
class UniqueidsController extends AppController {

	var $name = 'Uniqueids';
	var $helpers = array('Html', 'Form');

	function add() {
		if (!empty($this->data)) {
			$this->Uniqueid->create();
			$this->data["Uniqueid"]["user_id"] = $this->othAuth->user('id');
			if ($this->Uniqueid->save($this->data)) {				
				$this->Session->setFlash(__('Saved.', true));
				$this->redirect(array('controller' => 'users','action'=>'edit', $this->othAuth->user('id')));
				exit();
			} else {
				$this->Session->setFlash(__('Error. Please, try again.', true));
				$this->redirect($this->referer(null, true));
				exit();
			}
		}
		else
		{
			$this->redirect($this->referer(null, true));
			exit();			
		}
	}

	/*
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Uniqueid', true));
			$this->redirect(array('controller' => 'users','action'=>'edit', $this->othAuth->user('id')));
			exit();
		}
		if (!empty($this->data)) {
			$this->data["Uniqueid"]["user_id"] = $this->othAuth->user('id');
			if ($this->Uniqueid->save($this->data)) {
				$this->Session->setFlash(__('The Uniqueid has been saved', true));
				$this->redirect(array('controller' => 'users','action'=>'edit', $this->othAuth->user('id')));
				exit();
			} else {
				$this->Session->setFlash(__('The Uniqueid could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Uniqueid->read(null, $id);
		}
		$users = $this->Uniqueid->User->find('list');
		$games = $this->Uniqueid->Game->find('list');
		$this->set(compact('users','games'));
	}
	*/

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Uniqueid', true));
			$this->redirect($this->referer(null, true));
			exit();
		}
		if ($this->Uniqueid->del($id)) {
			$this->Session->setFlash(__('Uniqueid deleted', true));
			$this->redirect($this->referer(null, true));
			exit();
		}
	}


	function admin_index() {
		$this->Uniqueid->recursive = 0;
		$this->set('uniqueids', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Uniqueid.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('uniqueid', $this->Uniqueid->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Uniqueid->create();
			if ($this->Uniqueid->save($this->data)) {
				$this->Session->setFlash(__('The Uniqueid has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Uniqueid could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Uniqueid->User->find('list');
		$games = $this->Uniqueid->Game->find('list');
		$this->set(compact('users', 'games'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Uniqueid', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Uniqueid->save($this->data)) {
				$this->Session->setFlash(__('The Uniqueid has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Uniqueid could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Uniqueid->read(null, $id);
		}
		$users = $this->Uniqueid->User->find('list');
		$games = $this->Uniqueid->Game->find('list');
		$this->set(compact('users','games'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Uniqueid', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Uniqueid->del($id)) {
			$this->Session->setFlash(__('Uniqueid deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>