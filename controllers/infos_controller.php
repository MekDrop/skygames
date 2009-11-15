<?php
class InfosController extends AppController {

	var $name = 'Infos';
	var $helpers = array('Html','Form','Javascript','othAuth','Cache');
	var $paginate = array('Infocomment' => array('limit' => 8, 'page' => 'last'));

	var $cacheAction = array(
	 'latest/' => 600,
	 'index/' => 600,
	 );
	 
    var $contentHelpers = array("0" => array('name'=>'feeds', 'cachetime' => array('cache'=>'1 hour')));
	 

	function index() {

		$this->Info->recursive = 1;
		$this->paginate = array('limit'=>'5', 'order' => 'Info.created DESC', 'conditions' => array('Lang.code' => $this->userLangCode));
		$infos = $this->paginate();				
		$this->set('infos', $infos);
		$this->contentFullFill = true;
	}

	function latest()
	{
		$this->Event->recursive = 0;
		
		$this->Info->unbindModel(array('hasMany' => array('Infocomment')));
		$infos = $this->Info->findAll(null, null, 'Info.created DESC', 5);
		if(isset($this->params['requested'])) {		 	 
             return $infos;
        } 
		else
		$this->set('infos', $infos);
	}

	function view($id = null) {
				
		if (!$id) {
			$this->flash(__('Invalid Info', true), array('action'=>'index'));
		}
		$info = $this->Info->read(null, $id);
		$this->set('info', $info);
		$comments = $this->paginate('Infocomment', array('info_id' => $id));		
		$this->set('comments', $comments);
		
		$this->titleForContent = '<b>' . $info['Info']['title']. '</b> :: ' . $info['Info']['created'];
	}
		
	/*function add() {
		if (!empty($this->data)) {
			$this->Info->create();
			if ($this->Info->save($this->data)) {
				$this->flash(__('Info saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		$users = $this->Info->User->find('list');
		$infocats = $this->Info->Infocat->find('list');
		$langs = $this->Info->Lang->find('list');
		$games = $this->Info->Game->find('list');
		$this->set(compact('users', 'infocats', 'langs', 'games'));
	}*/	
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Info', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {
			if ($this->Info->save($this->data)) {
				$this->flash(__('The Info has been saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Info->read(null, $id);
		}
		$users = $this->Info->User->find('list');
		$infocats = $this->Info->Infocat->find('list');
		$langs = $this->Info->Lang->find('list');
		$games = $this->Info->Game->find('list');
		$this->set(compact('users','infocats','langs','games'));
	}

	/*function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Info', true), array('action'=>'index'));
		}
		if ($this->Info->del($id)) {
			$this->flash(__('Info deleted', true), array('action'=>'index'));
		}
	}*/


	function admin_index() {
		$this->Info->recursive = 0;
		$this->set('infos', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Info', true), array('action'=>'index'));
		}
		$this->set('info', $this->Info->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->data['Info']['user_id'] = $this->othAuth->user('id');
			$this->Info->create();
			if ($this->Info->save($this->data)) {
				$this->flash(__('Info saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		
		
		$users = $this->Info->User->find('list');
		$infocats = $this->Info->Infocat->find('list');
		$langs = $this->Info->Lang->find('list');
		$games = $this->Info->Game->find('list');
		$this->set(compact('users', 'infocats', 'langs', 'games'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Info', true), array('action'=>'index'));
			exit();
		}
		if (!empty($this->data)) {			
			if ($this->Info->save($this->data)) {
				$this->flash(__('The Info has been saved.', true), array('action'=>'index'));
				exit();
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Info->read(null, $id);
		}
		$users = $this->Info->User->find('list');
		$infocats = $this->Info->Infocat->find('list');
		$langs = $this->Info->Lang->find('list');
		$games = $this->Info->Game->find('list');
		$this->set(compact('users','infocats','langs','games'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Info', true), array('action'=>'index'));
		}
		if ($this->Info->del($id)) {
			$this->flash(__('Info deleted', true), array('action'=>'index'));
		}
	}

}
?>