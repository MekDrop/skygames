<?php
class CustcommentsController extends AppController {

	var $name = 'Custcomments';
	var $helpers = array('Html', 'Form', 'OthAuth', 'Paginator');
	var $commentModel = null;
	var $autoRender = false;

	function beforeFilter()
	{
		parent::beforeFilter();
		if (!$this->commentModel)
		$this->commentModel = $this->Custcomment;
	}

	function index() {

		$this->commentModel->recursive = 0;
		$this->set('custcomments', $this->paginate());

		$this->render('index', 'skygames', '/custcomments/index');
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Custcomment.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('custcomment', $this->commentModel->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->commentModel->create();
			if ($this->commentModel->save($this->data)) {
				$this->Session->setFlash(__('The Custcomment has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Custcomment could not be saved. Please, try again.', true));
			}
		}
		$users = $this->commentModel->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Custcomment', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->commentModel->save($this->data)) {
				$this->Session->setFlash(__('The Custcomment has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Custcomment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->commentModel->read(null, $id);
		}
		$users = $this->commentModel->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Custcomment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->commentModel->del($id)) {
			$this->Session->setFlash(__('Custcomment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->commentModel->recursive = 0;
		$this->set('custcomments', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Custcomment.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('custcomment', $this->commentModel->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->commentModel->create();
			if ($this->commentModel->save($this->data)) {
				$this->Session->setFlash(__('The Custcomment has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Custcomment could not be saved. Please, try again.', true));
			}
		}
		$users = $this->commentModel->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Custcomment', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->commentModel->save($this->data)) {
				$this->Session->setFlash(__('The Custcomment has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Custcomment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->commentModel->read(null, $id);
		}
		$users = $this->commentModel->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Custcomment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->commentModel->del($id)) {
			$this->Session->setFlash(__('Custcomment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>