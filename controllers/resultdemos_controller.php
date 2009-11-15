<?php
class ResultdemosController extends AppController {

	var $name = 'Resultdemos';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Resultdemo->recursive = 0;
		$this->set('resultdemos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Resultdemo', true), array('action'=>'index'));
		}
		$this->set('resultdemo', $this->Resultdemo->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Resultdemo->create();
			if ($this->Resultdemo->save($this->data)) {
				$this->flash(__('Resultdemo saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		$results = $this->Resultdemo->Result->find('list');
		$this->set(compact('results'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Resultdemo', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Resultdemo->save($this->data)) {
				$this->flash(__('The Resultdemo has been saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Resultdemo->read(null, $id);
		}
		$results = $this->Resultdemo->Result->find('list');
		$this->set(compact('results'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Resultdemo', true), array('action'=>'index'));
		}
		if ($this->Resultdemo->del($id)) {
			$this->flash(__('Resultdemo deleted', true), array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Resultdemo->recursive = 0;
		$this->set('resultdemos', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Resultdemo', true), array('action'=>'index'));
		}
		$this->set('resultdemo', $this->Resultdemo->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Resultdemo->create();
			if ($this->Resultdemo->save($this->data)) {
				$this->flash(__('Resultdemo saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		$results = $this->Resultdemo->Result->find('list');
		$this->set(compact('results'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Resultdemo', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Resultdemo->save($this->data)) {
				$this->flash(__('The Resultdemo has been saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Resultdemo->read(null, $id);
		}
		$results = $this->Resultdemo->Result->find('list');
		$this->set(compact('results'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Resultdemo', true), array('action'=>'index'));
		}
		if ($this->Resultdemo->del($id)) {
			$this->flash(__('Resultdemo deleted', true), array('action'=>'index'));
		}
	}

}
?>