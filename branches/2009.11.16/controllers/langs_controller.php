<?php
class LangsController extends AppController {

	var $name = 'Langs';
	var $helpers = array('Html', 'Form');

	function admin_index() {
		$this->Lang->recursive = 0;
		$this->set('langs', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Lang', true), array('action'=>'index'));
		}
		$this->set('lang', $this->Lang->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Lang->create();
			if ($this->Lang->save($this->data)) {
				$this->flash(__('Lang saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Lang', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Lang->save($this->data)) {
				$this->flash(__('The Lang has been saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Lang->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Lang', true), array('action'=>'index'));
		}
		if ($this->Lang->del($id)) {
			$this->flash(__('Lang deleted', true), array('action'=>'index'));
		}
	}

}
?>