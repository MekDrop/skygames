<?php
class InfosController extends AppController {

	var $name = 'Infos';
	var $helpers = array('Html', 'Form', 'Javascript', 'othAuth', 'Cache');
	var $paginate = array('Infocomment' => array('limit' => 8, 'page' => 'last'));

	
	var $cacheAction = array(
	 //'index' => "+1 hour",
	 'view/' => "+1 hour",
	 'info/' => "+1 hour",	
	 'event' => "+1 hour",
	 );
	 
	 

    var $contentHelpers = array("0" => array('name'=>'feeds', 'cachetime' => array('cache'=>'+1 hour')));
	 

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
		$infos = $this->Info->findAll(array('Lang.code' => $this->userLangCode), null, 'Info.created DESC', 5);
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
	
	function addcomment($id = null)
	{
		if (!empty($this->data)) {

		$this->Info->bindModel(array('hasMany'=>array (		
			'Infocomment' => array('className' => 'Infocomment',
								'foreignKey' => 'info_id',
							
			)
		)));	

			$this->data['Infocomment']['user_id'] = $this->othAuth->user('id');
			$this->Info->Infocomment->create();
			if ($this->Info->Infocomment->save($this->data)) {
				$this->Session->setFlash(__('Comment has been submited', true));		
				$this->redirect(array('action'=>'view', $this->data['Infocomment']['info_id']));										
				exit();
			} else {
				$this->Session->setFlash(__('Error occured', true));
				$this->redirect(array('action'=>'view', $this->data['Infocomment']['info_id']));										
				exit();
			}
		}		
	}


	function admin_index() {
		$this->Info->recursive = 0;
		$this->paginate = array('order' => 'Info.created DESC');
		$paginate =  $this->paginate();		
		$this->set('infos', $paginate);
		$this->contentFullFill = true;
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
				//$this->flash(__('Info saved.', true), array('action'=>'index'));
				//exit();
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