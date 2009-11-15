<?php
class UserdetailsController extends AppController {

	var $name = 'Userdetails';
	var $helpers = array('Html', 'Form');


	function add() {
		if (!empty($this->data)) {
			$this->data['Userdetail']['user_id'] = $this->othAuth->user('id');
			$this->data['Userdetail']['pers_more'] = nl2br($this->data['Userdetail']['pers_more']);
			$this->Userdetail->create();
			if ($this->Userdetail->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));				
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		$this->redirect(array('controller'=>'users', 'action'=>'edit', $this->data['Userdetail']['user_id']));										
		exit();
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Userdetail', true));
		}
		if (!empty($this->data)) {
			$this->data['Userdetail']['user_id'] = $this->othAuth->user('id');
			if ($this->Userdetail->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
	
		$this->redirect(array('controller'=>'users', 'action'=>'edit', $this->data['Userdetail']['user_id']));										
		exit();
	}




	function admin_index() {
		$this->Userdetail->recursive = 0;
		$this->set('userdetails', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Userdetail.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('userdetail', $this->Userdetail->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Userdetail->create();
			if ($this->Userdetail->save($this->data)) {
				$this->Session->setFlash(__('The Userdetail has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Userdetail could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Userdetail->User->find('list');
		$this->set(compact('users'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Userdetail', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Userdetail->save($this->data)) {
				$this->Session->setFlash(__('The Userdetail has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Userdetail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Userdetail->read(null, $id);
		}
		$users = $this->Userdetail->User->find('list');
		$this->set(compact('users'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Userdetail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Userdetail->del($id)) {
			$this->Session->setFlash(__('Userdetail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>