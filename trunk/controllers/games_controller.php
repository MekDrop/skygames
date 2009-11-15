<?php
class GamesController extends AppController {

	var $name = 'Games';
	var $helpers = array('Html', 'Form');


	function admin_index() {
		$this->Game->recursive = 0;
		$this->set('games', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Game.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('game', $this->Game->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Game->create();
			if ($this->Game->save($this->data)) {
				$this->Session->setFlash(__('The Game has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Game could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Game', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Game->save($this->data)) {
				$this->Session->setFlash(__('The Game has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Game could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Game->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Game', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Game->del($id)) {
			$this->Session->setFlash(__('Game deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>