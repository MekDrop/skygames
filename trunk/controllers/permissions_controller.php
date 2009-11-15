<?php
class PermissionsController extends AppController {

	var $name = 'Permissions';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Permission->recursive = 0;
		$this->set('permissions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Permission', true), array('action'=>'index'));
		}
		$this->set('permission', $this->Permission->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Permission->create();
			if ($this->Permission->save($this->data)) {
				$this->flash(__('Permission saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		$groups = $this->Permission->Group->find('list');
		$this->set(compact('groups'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Permission', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Permission->save($this->data)) {
				$this->flash(__('The Permission has been saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Permission->read(null, $id);
		}
		$groups = $this->Permission->Group->find('list');
		$this->set(compact('groups'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Permission', true), array('action'=>'index'));
		}
		if ($this->Permission->del($id)) {
			$this->flash(__('Permission deleted', true), array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Permission->recursive = 0;
		$this->set('permissions', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Permission', true), array('action'=>'index'));
		}
		$this->set('permission', $this->Permission->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Permission->create();
			if ($this->Permission->save($this->data)) {
				$this->flash(__('Permission saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		$groups = $this->Permission->Group->find('list');
		$this->set(compact('groups'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Permission', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Permission->save($this->data)) {
				$this->flash(__('The Permission has been saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Permission->read(null, $id);
		}
		$groups = $this->Permission->Group->find('list');
		$this->set(compact('groups'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Permission', true), array('action'=>'index'));
		}
		if ($this->Permission->del($id)) {
			$this->flash(__('Permission deleted', true), array('action'=>'index'));
		}
	}

}
?>