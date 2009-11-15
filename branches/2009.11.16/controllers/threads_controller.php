<?php
class ThreadsController extends AppController {

	var $name = 'Threads';
	var $helpers = array('Html', 'Form', 'Cache');

	/*function index() {
		$this->Thread->recursive = 0;
		$this->set('threads', $this->paginate());
		}*/

	function latest()
	{
		$sql = 'SELECT Thread.*, User.*, langs.code FROM threadcats, threads Thread, langs, users User WHERE User.id = Thread.user_id AND Thread.threadcat_id = threadcats.id AND langs.id = threadcats.lang_id AND langs.code = \'%lang%\' ORDER BY Thread.created DESC LIMIT 0 , 5';
		$sql = str_replace(array('%count%', '%lang%'), array( 5, $this->userLangCode), $sql);
		$threads = $this->Thread->query($sql);
/*		$this->Event->recursive = 0;
		$this->Thread->unbindModel( array ( 'hasMany' => array ('Post') ) );
		$threads = $this->Thread->findAll(null, null, 'Thread.created DESC', 5); //*/
		if(isset($this->params['requested'])) {
			return $threads;
		}
		else
		$this->set('threads', $threads);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Thread.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('thread', $this->Thread->read(null, $id));
		$posts = $this->Thread->Post->findAll(array('thread_id'=>$id));
		$this->set('posts', $posts);
	}

	function add($id) {
		if (!empty($this->data)) {
			$this->data['Thread']['user_id'] = $this->othAuth->user('id');
			$this->data['Thread']['body'] = nl2br($this->data['Thread']['body']);
			$this->Thread->create();
			if ($this->Thread->save($this->data)) {
				$this->Session->setFlash(__('Thread has been posted', true));
				$this->redirect(array('controller'=>'threadcats','action'=>'view', $this->data['Thread']['threadcat_id']));

			} else {
				$this->Session->setFlash(__('The Thread could not be saved. Please, try again.', true));
			}
		}

		$users = $this->Thread->User->find('list');
		$threadcats = $this->Thread->Threadcat->find('list');
		$threadcat = $this->Thread->Threadcat->read(null, $id);
		$this->set(compact('users', 'threadcats'));
		$this->set('threadCatId', $id);
		$this->set('threadcat', $threadcat);


		$this->titleForContent = '<b>' . __('New thread',true) . '</b>';
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Thread', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Thread->save($this->data)) {
				$this->Session->setFlash(__('The Thread has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Thread could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Thread->read(null, $id);
		}
		$users = $this->Thread->User->find('list');
		$threadcats = $this->Thread->Threadcat->find('list');
		$this->set(compact('users','threadcats'));
	}

	/*function delete($id = null) {
		if (!$id) {
		$this->Session->setFlash(__('Invalid id for Thread', true));
		$this->redirect(array('action'=>'index'));
		}
		if ($this->Thread->del($id)) {
		$this->Session->setFlash(__('Thread deleted', true));
		$this->redirect(array('action'=>'index'));
		}
		}*/


	function admin_index() {
		$this->Thread->recursive = 0;
		$this->set('threads', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Thread.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('thread', $this->Thread->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Thread->create();
			if ($this->Thread->save($this->data)) {
				$this->Session->setFlash(__('The Thread has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Thread could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Thread->User->find('list');
		$threadcats = $this->Thread->Threadcat->find('list');
		$this->set(compact('users', 'threadcats'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Thread', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Thread->save($this->data)) {
				$this->Session->setFlash(__('The Thread has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Thread could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Thread->read(null, $id);
		}
		$users = $this->Thread->User->find('list');
		$threadcats = $this->Thread->Threadcat->find('list');
		$this->set(compact('users','threadcats'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Thread', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Thread->del($id)) {
			$this->Session->setFlash(__('Thread deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>