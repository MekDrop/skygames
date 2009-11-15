<?php
class AdminmenusController extends AppController {

	var $name = 'Adminmenus';
	var $helpers = array('Html', 'Form');

	function index() {
		$result = $this->paginate();
		if(isset($this->params['requested'])) {
			return $result;
		}
		$this->Adminmenu->recursive = 0;
		$this->set('adminmenus', $result);
	} 
	/* 
	 function view($id = null) {
		if (!$id) {
		$this->Session->setFlash(__('Invalid Adminmenu.', true));
		$this->redirect(array('action'=>'index'));
		}
		$this->set('adminmenu', $this->Adminmenu->read(null, $id));
		}

		function add() {
		if (!empty($this->data)) {
		$this->Adminmenu->create();
		if ($this->Adminmenu->save($this->data)) {
		$this->Session->setFlash(__('The Adminmenu has been saved', true));
		$this->redirect(array('action'=>'index'));
		exit;
		} else {
		$this->Session->setFlash(__('The Adminmenu could not be saved. Please, try again.', true));
		}
		}
		}

		function edit($id = null) {
		if (!$id && empty($this->data)) {
		$this->Session->setFlash(__('Invalid Adminmenu', true));
		$this->redirect(array('action'=>'index'));
		exit;
		}
		if (!empty($this->data)) {
		if ($this->Adminmenu->save($this->data)) {
		$this->Session->setFlash(__('The Adminmenu has been saved', true));
		$this->redirect(array('action'=>'index'));
		} else {
		$this->Session->setFlash(__('The Adminmenu could not be saved. Please, try again.', true));
		}
		}
		if (empty($this->data)) {
		$this->data = $this->Adminmenu->read(null, $id);
		}
		}

		function delete($id = null) {
		if (!$id) {
		$this->Session->setFlash(__('Invalid id for Adminmenu', true));
		$this->redirect(array('action'=>'index'));
		}
		if ($this->Adminmenu->del($id)) {
		$this->Session->setFlash(__('Adminmenu deleted', true));
		$this->redirect(array('action'=>'index'));
		}
		}
		*/

	function admin_index() {
		$this->Adminmenu->recursive = 0;
		$this->set('adminmenus', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Adminmenu.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('adminmenu', $this->Adminmenu->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Adminmenu->create();
			if ($this->Adminmenu->save($this->data)) {
				$this->Session->setFlash(__('The Adminmenu has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Adminmenu could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Adminmenu', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Adminmenu->save($this->data)) {
				$this->Session->setFlash(__('The Adminmenu has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Adminmenu could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Adminmenu->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Adminmenu', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Adminmenu->del($id)) {
			$this->Session->setFlash(__('Adminmenu deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>