<?php
class PlayofftablesController extends AppController {

	var $name = 'Playofftables';
	var $helpers = array('Html', 'Form');
	
	var $contentHelpers = false;

	function view($id = null) {
		
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid Playofftable.', true));
			$this->redirect(array('action'=>'index'));
		}
		$pt = $this->Playofftable->read(null, $id);
		$this->set('playofftable', $pt);
		$matches = $this->Playofftable->Match->findAll(array('playofftable_id'=>$id));
		$this->set('matches', $matches);
		
		$this->titleForContent = '<b>' . $pt['Playofftable']['name'] . '<b/>';
	}


	function admin_index() {
		$this->Playofftable->recursive = 0;
		$this->set('playofftables', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Playofftable.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('playofftable', $this->Playofftable->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Playofftable->create();
			if ($this->Playofftable->save($this->data)) {
				$this->Session->setFlash(__('The Playofftable has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Playofftable could not be saved. Please, try again.', true));
			}
		}
		$events = $this->Playofftable->Event->find('list');
		$this->set(compact('events'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Playofftable', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Playofftable->save($this->data)) {
				$this->Session->setFlash(__('The Playofftable has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Playofftable could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Playofftable->read(null, $id);
		}
		$events = $this->Playofftable->Event->find('list');
		$this->set(compact('events'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Playofftable', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Playofftable->del($id)) {
			$this->Session->setFlash(__('Playofftable deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>