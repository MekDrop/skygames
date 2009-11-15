<?php
class ResultpicturesController extends AppController {

	var $name = 'Resultpictures';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Resultpicture->recursive = 0;
		$this->set('resultpictures', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Resultpicture', true), array('action'=>'index'));
		}
		$this->set('resultpicture', $this->Resultpicture->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Resultpicture->create();
			if ($this->Resultpicture->save($this->data)) {
				$this->flash(__('Resultpicture saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		$results = $this->Resultpicture->Result->find('list');
		$this->set(compact('results'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Resultpicture', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Resultpicture->save($this->data)) {
				$this->flash(__('The Resultpicture has been saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Resultpicture->read(null, $id);
		}
		$results = $this->Resultpicture->Result->find('list');
		$this->set(compact('results'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Resultpicture', true), array('action'=>'index'));
		}
		if ($this->Resultpicture->del($id)) {
			$this->flash(__('Resultpicture deleted', true), array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Resultpicture->recursive = 0;
		$this->set('resultpictures', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Resultpicture', true), array('action'=>'index'));
		}
		$this->set('resultpicture', $this->Resultpicture->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Resultpicture->create();
			if ($this->Resultpicture->save($this->data)) {
				$this->flash(__('Resultpicture saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		$results = $this->Resultpicture->Result->find('list');
		$this->set(compact('results'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Resultpicture', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Resultpicture->save($this->data)) {
				$this->flash(__('The Resultpicture has been saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Resultpicture->read(null, $id);
		}
		$results = $this->Resultpicture->Result->find('list');
		$this->set(compact('results'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Resultpicture', true), array('action'=>'index'));
		}
		if ($this->Resultpicture->del($id)) {
			$this->flash(__('Resultpicture deleted', true), array('action'=>'index'));
		}
	}

}
?>