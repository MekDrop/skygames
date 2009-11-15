<?php
class PostsController extends AppController {

	var $name = 'Posts';
	var $helpers = array('Html', 'Form');

	/*function index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
	}*/

	/*function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Post.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}*/

	function latest()
	{
		$this->Event->recursive = 0;

		$posts = $this->Post->findAll(null, null, 'post.created DESC', 5);
		if(isset($this->params['requested'])) {		 	 
             return $posts;
        } 
		else
		$this->set('posts', $posts);
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->data['Post']['user_id'] = $this->othAuth->user('id');
			$this->data['Post']['body'] = nl2br($this->data['Post']['body']);
			$this->Post->create();
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('Post has been submited', true));		
				$this->redirect(array('controller'=>'threads','action'=>'view', $this->data['Post']['thread_id']));										
				exit();			
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Post->User->find('list');
		$threads = $this->Post->Thread->find('list');
		$this->set(compact('users', 'threads'));
	}

	/*function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Post', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Post->read(null, $id);
		}
		$users = $this->Post->User->find('list');
		$threads = $this->Post->Thread->find('list');
		$this->set(compact('users','threads'));
	}*/

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Post', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Post->del($id)) {
			$this->Session->setFlash(__('Post deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->Post->recursive = 0;
		$this->set('posts', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Post.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('post', $this->Post->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Post->create();
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Post->User->find('list');
		$threads = $this->Post->Thread->find('list');
		$this->set(compact('users', 'threads'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Post', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Post->read(null, $id);
		}
		$users = $this->Post->User->find('list');
		$threads = $this->Post->Thread->find('list');
		$this->set(compact('users','threads'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Post', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Post->del($id)) {
			$this->Session->setFlash(__('Post deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>