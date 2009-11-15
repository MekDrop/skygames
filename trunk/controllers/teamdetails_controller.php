<?php
class TeamdetailsController extends AppController {

	var $name = 'Teamdetails';
	var $helpers = array('Html', 'Form');





	function add() {
		if (!empty($this->data)) {
			$this->Teamdetail->create();
			if ($this->Teamdetail->save($this->data)) {
				$this->Session->setFlash(__('The Teamdetail has been saved', true));
				$this->redirect(array('controller'=>'teams', 'action'=>'edit', $this->data['Teamdetail']['team_id']));
			} else {
				$this->Session->setFlash(__('The Teamdetail could not be saved. Please, try again.', true));
			}
		}
		$teams = $this->Teamdetail->Team->find('list');
		$this->set(compact('teams'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Teamdetail', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Teamdetail->save($this->data)) {
				$this->Session->setFlash(__('The Teamdetail has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Teamdetail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Teamdetail->read(null, $id);
		}
		$teams = $this->Teamdetail->Team->find('list');
		$this->set(compact('teams'));
	}



	function admin_index() {
		$this->Teamdetail->recursive = 0;
		$this->set('teamdetails', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Teamdetail.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('teamdetail', $this->Teamdetail->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Teamdetail->create();
			if ($this->Teamdetail->save($this->data)) {
				$this->Session->setFlash(__('The Teamdetail has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Teamdetail could not be saved. Please, try again.', true));
			}
		}
		$teams = $this->Teamdetail->Team->find('list');
		$this->set(compact('teams'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Teamdetail', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Teamdetail->save($this->data)) {
				$this->Session->setFlash(__('The Teamdetail has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Teamdetail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Teamdetail->read(null, $id);
		}
		$teams = $this->Teamdetail->Team->find('list');
		$this->set(compact('teams'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Teamdetail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Teamdetail->del($id)) {
			$this->Session->setFlash(__('Teamdetail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>