<?php
class MatchpartsController extends AppController {

	var $name = 'Matchparts';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Matchpart->recursive = 0;
		$this->set('matchparts', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Matchpart', true), array('action'=>'index'));
		}
		$this->set('matchpart', $this->Matchpart->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Matchpart->create();
			if ($this->Matchpart->save($this->data)) {
				$this->flash(__('Matchpart saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		$games = $this->Matchpart->Game->find('list');
		$this->set(compact('games'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Matchpart', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Matchpart->save($this->data)) {
				$this->flash(__('The Matchpart has been saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Matchpart->read(null, $id);
		}
		$games = $this->Matchpart->Game->find('list');
		$this->set(compact('games'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Matchpart', true), array('action'=>'index'));
		}
		if ($this->Matchpart->del($id)) {
			$this->flash(__('Matchpart deleted', true), array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Matchpart->recursive = 0;
		$this->set('matchparts', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Matchpart', true), array('action'=>'index'));
		}
		$this->set('matchpart', $this->Matchpart->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Matchpart->create();
			if ($this->Matchpart->save($this->data)) {
				$this->flash(__('Matchpart saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		$games = $this->Matchpart->Game->find('list');
		$this->set(compact('games'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Matchpart', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Matchpart->save($this->data)) {
				$this->flash(__('The Matchpart has been saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Matchpart->read(null, $id);
		}
		$games = $this->Matchpart->Game->find('list');
		$this->set(compact('games'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Matchpart', true), array('action'=>'index'));
		}
		if ($this->Matchpart->del($id)) {
			$this->flash(__('Matchpart deleted', true), array('action'=>'index'));
		}
	}

}
?>