<?php
class ThreadcatsController extends AppController {

	var $name = 'Threadcats';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Threadcat->recursive = 1;
		$this->paginate = array('limit'=>'5', 'order' => 'Threadcat.position DESC', 'conditions' => array('Lang.code' => $this->userLangCode));
		$this->set('threadcats', $this->paginate());
	}

	function view($id = null) {
		$this->contentHelpers = false;

		if (!$id) {
			$this->Session->setFlash(__('Invalid Threadcat.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('threadcat', $this->Threadcat->read(null, $id));
		$threads = $this->Threadcat->Thread->recursive = 1;
		$threads = $this->Threadcat->Thread->findAll(array('threadcat_id'=> $id));
		$this->set('threads', $threads);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Threadcat->create();
			$this->data['Threadcat']['body'] = nl2br($this->data['Threadcat']['body']);
			if ($this->Threadcat->save($this->data)) {
				$this->Session->setFlash(__('The Threadcat has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Threadcat could not be saved. Please, try again.', true));
			}
		}
		$games = $this->Threadcat->Game->find('list');
		$langs = $this->Threadcat->Lang->find('list');
		$this->set(compact('games', 'langs'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Threadcat', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Threadcat->save($this->data)) {
				$this->Session->setFlash(__('The Threadcat has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Threadcat could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Threadcat->read(null, $id);
		}
		$games = $this->Threadcat->Game->find('list');
		$langs = $this->Threadcat->Lang->find('list');
		$this->set(compact('games','langs'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Threadcat', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Threadcat->del($id)) {
			$this->Session->setFlash(__('Threadcat deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Threadcat->recursive = 0;
		$this->set('threadcats', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Threadcat.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('threadcat', $this->Threadcat->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Threadcat->create();
			if ($this->Threadcat->save($this->data)) {
				$this->Session->setFlash(__('The Threadcat has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Threadcat could not be saved. Please, try again.', true));
			}
		}
		$games = $this->Threadcat->Game->find('list');
		$langs = $this->Threadcat->Lang->find('list');
		$this->set(compact('games', 'langs'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Threadcat', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Threadcat->save($this->data)) {
				$this->Session->setFlash(__('The Threadcat has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Threadcat could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Threadcat->read(null, $id);
		}
		$games = $this->Threadcat->Game->find('list');
		$langs = $this->Threadcat->Lang->find('list');
		$this->set(compact('games','langs'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Threadcat', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Threadcat->del($id)) {
			$this->Session->setFlash(__('Threadcat deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>