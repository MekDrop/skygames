<?php
class EventtypesController extends AppController {

	var $name = 'Eventtypes';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Eventtype->recursive = 0;
		$this->set('eventtypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Eventtype.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('eventtype', $this->Eventtype->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Eventtype->create();
			if ($this->Eventtype->save($this->data)) {
				$this->Session->setFlash(__('The Eventtype has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Eventtype could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Eventtype', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Eventtype->save($this->data)) {
				$this->Session->setFlash(__('The Eventtype has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Eventtype could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Eventtype->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Eventtype', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Eventtype->del($id)) {
			$this->Session->setFlash(__('Eventtype deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Eventtype->recursive = 0;
		$this->set('eventtypes', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Eventtype.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('eventtype', $this->Eventtype->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Eventtype->create();
			if ($this->Eventtype->save($this->data)) {
				$this->Session->setFlash(__('The Eventtype has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Eventtype could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Eventtype', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Eventtype->save($this->data)) {
				$this->Session->setFlash(__('The Eventtype has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Eventtype could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Eventtype->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Eventtype', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Eventtype->del($id)) {
			$this->Session->setFlash(__('Eventtype deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>