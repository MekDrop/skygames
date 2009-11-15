<?php
class InfocommentsController extends AppController {

	var $name = 'Infocomments';
	var $helpers = array('Html', 'Form');
	

	function add() {
		if (!empty($this->data)) {
			$this->data['Infocomment']['user_id'] = $this->othAuth->user('id');
			$this->Infocomment->create();
			if ($this->Infocomment->save($this->data)) {
				$this->Session->setFlash(__('Comment has been submited', true));		
				$this->redirect(array('controller'=>'infos','action'=>'view', $this->data['Infocomment']['info_id']));										
				exit();
			} else {
				$this->Session->setFlash(__('Error occured', true));
				$this->redirect(array('controller'=>'infos','action'=>'view', $this->data['Infocomment']['info_id']));										
				exit();
			}
		}
		$users = $this->Infocomment->User->find('list');
		$infos = $this->Infocomment->Info->find('list');
		$this->set(compact('users', 'infos'));
	}

	/*
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Infocomment', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Infocomment->save($this->data)) {
				$this->flash(__('The Infocomment has been saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Infocomment->read(null, $id);
		}
		$users = $this->Infocomment->User->find('list');
		$infos = $this->Infocomment->Info->find('list');
		$this->set(compact('users','infos'));
	}
	*/
	/*
	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Infocomment', true), array('action'=>'index'));
		}
		if ($this->Infocomment->del($id)) {
			$this->flash(__('Infocomment deleted', true), array('action'=>'index'));
		}
	}
	*/

	function admin_index() {
		$this->Infocomment->recursive = 0;
		$this->set('infocomments', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Infocomment', true), array('action'=>'index'));
		}
		$this->set('infocomment', $this->Infocomment->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Infocomment->create();
			if ($this->Infocomment->save($this->data)) {
				$this->flash(__('Infocomment saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		$users = $this->Infocomment->User->find('list');
		$infos = $this->Infocomment->Info->find('list');
		$this->set(compact('users', 'infos'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Infocomment', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Infocomment->save($this->data)) {
				$this->flash(__('The Infocomment has been saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Infocomment->read(null, $id);
		}
		$users = $this->Infocomment->User->find('list');
		$infos = $this->Infocomment->Info->find('list');
		$this->set(compact('users','infos'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Infocomment', true), array('action'=>'index'));
		}
		if ($this->Infocomment->del($id)) {
			$this->flash(__('Infocomment deleted', true), array('action'=>'index'));
		}
	}

}
?>