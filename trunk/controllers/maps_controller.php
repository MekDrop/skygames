<?php
class MapsController extends AppController {

	var $name = 'Maps';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Map->recursive = 0;
		$this->set('maps', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Map.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('map', $this->Map->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Map->create();
			if ($this->Map->save($this->data)) {
				$this->Session->setFlash(__('The Map has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Map could not be saved. Please, try again.', true));
			}
		}
		$games = $this->Map->Game->find('list');
		$this->set(compact('games'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Map', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Map->save($this->data)) {
				$this->Session->setFlash(__('The Map has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Map could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Map->read(null, $id);
		}
		$games = $this->Map->Game->find('list');
		$this->set(compact('games'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Map', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Map->del($id)) {
			$this->Session->setFlash(__('Map deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Map->recursive = 0;
		$this->set('maps', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Map.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('map', $this->Map->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Map->create();
			if ($this->Map->save($this->data)) {
				$this->Session->setFlash(__('The Map has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Map could not be saved. Please, try again.', true));
			}
		}
		$games = $this->Map->Game->find('list');
		$this->set(compact('games'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Map', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Map->save($this->data)) {
				$this->Session->setFlash(__('The Map has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Map could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Map->read(null, $id);
		}
		$games = $this->Map->Game->find('list');
		$this->set(compact('games'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Map', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Map->del($id)) {
			$this->Session->setFlash(__('Map deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>