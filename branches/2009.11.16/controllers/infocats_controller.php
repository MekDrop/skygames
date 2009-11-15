<?php
class InfocatsController extends AppController {

	var $name = 'Infocats';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Infocat->recursive = 0;
		$this->set('infocats', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Infocat.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('infocat', $this->Infocat->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Infocat->create();
			if ($this->Infocat->save($this->data)) {
				$this->Session->setFlash(__('The Infocat has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Infocat could not be saved. Please, try again.', true));
			}
		}
		$games = $this->Infocat->Game->find('list');
		$this->set(compact('games'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Infocat', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Infocat->save($this->data)) {
				$this->Session->setFlash(__('The Infocat has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Infocat could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Infocat->read(null, $id);
		}
		$games = $this->Infocat->Game->find('list');
		$this->set(compact('games'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Infocat', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Infocat->del($id)) {
			$this->Session->setFlash(__('Infocat deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Infocat->recursive = 0;
		$this->set('infocats', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Infocat.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('infocat', $this->Infocat->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Infocat->create();
			if ($this->Infocat->save($this->data)) {
				$this->Session->setFlash(__('The Infocat has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Infocat could not be saved. Please, try again.', true));
			}
		}
		$games = $this->Infocat->Game->find('list');
		$this->set(compact('games'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Infocat', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Infocat->save($this->data)) {
				$this->Session->setFlash(__('The Infocat has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Infocat could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Infocat->read(null, $id);
		}
		$games = $this->Infocat->Game->find('list');
		$this->set(compact('games'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Infocat', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Infocat->del($id)) {
			$this->Session->setFlash(__('Infocat deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>