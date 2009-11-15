<?php
class UsersController extends AppController {

	var $name = 'Users';

	var $helpers = array('Html', 'Form', 'Paginator');

	var $paginate = array('Usercomment' => array('limit' => 8, 'page' => 0, 'order' => 'Usercomment.created desc'), 'User' => array('order' => 'User.created desc'));

	var $components = array('Upload', 'Email');

	var $cacheAction = array(

	);

	function autocomplete()
	{
		Configure::write('debug', '0');
		$this->layout = 'ajax';

		if (isset($this->data['User']['name']))
			$match = $this->data['User']['name'];
		if (isset($this->data['Org']['user_name']))
			$match = $this->data['Org']['user_name'];			
			
		$users = $this->User->findAll( "User.name LIKE '%{$match}%'", array('User.name','User.email'), 'User.name ASC', 20);
		$this->set('users',$users );
	}

	function generatePassword($length=6,$level=2){

		list($usec, $sec) = explode(' ', microtime());
		srand((float) $sec + ((float) $usec * 100000));

		$validchars[1] = "0123456789abcdfghjkmnpqrstvwxyz";
		$validchars[2] = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$validchars[3] = "0123456789_!@#$%&*()-=+/abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_!@#$%&*()-=+/";

		$password  = "";
		$counter   = 0;

		while ($counter < $length) {
			$actChar = substr($validchars[$level], rand(0, strlen($validchars[$level])-1), 1);

			// All character must be different
			if (!strstr($password, $actChar)) {
				$password .= $actChar;
				$counter++;
			}
		}

		return $password;

	}

	function reset() {
		
		
		if (strlen($this->data["User"]["email"]) > 0)
		{
			$user = $this->User->findAll(array("email" => $this->data["User"]["email"]));
				
			if ($user)
			{
				$user = $user[0]["User"];
				$this->Email->template = 'email/reset';
				 
				$this->Email->to = $user["email"];
				$this->Email->subject = __('SkyGames.lt: Password Reset',true);
				 
				$newPassword = $this->generatePassword();
				$this->set('newPassword', $newPassword);
				$this->set('username', $user["username"]);
				
				
				
				$result = $this->Email->send();
				 
				if ($result)
				{
					$user["passwd"] = md5($newPassword);
						
					if ($this->User->save($user))
					{
						$this->Session->setflash(__('Letter with your new password sent successfully. Check your email.',true));
						$this->redirect(array("action" => "login"));
						exit();
					}
					else
					{
						$this->Session->setflash(__('Error has occured. Please contact web administrator.',true));
					}
				}
				else
				{
					$this->Session->setflash(__('Error has occured while sending mail. Please contact web administrator.',true));
				}
			}
			else
			{
				$this->Session->setflash(__('The email you provided can not be found.',true));
			}
				

		}

		 

	}

	function login()
	{
		if(isset($this->params['data']))
		{
			$this->params['data']['cookie'] = 1;
			$auth_num = $this->othAuth->login($this->params['data']['User']);
			$this->set('auth_msg', $this->othAuth->getMsg($auth_num));
			//$this->flash('You are now logged in!','');
		}

		$this->titleForContent = '<b>' . __('Login', true) . '</b>';
	}

	function logout()
	{
		$this->othAuth->logout();
		$this->Session->setflash(__('You are now logged out!', true));
		$this->redirect('/');
		exit();
	}

	function noaccess()
	{
		$this->flash("You don't have permissions to access this page.",'/users/login');
	}

	function upload() {

		if (empty($this->data)) {
			return false;
		} else {
				
			$id = $this->data['User']['id'];

			// set the upload destination folder
			$destination = ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS . 'img' . DS . 'uploads' . DS . 'avatars' . DS;

			// grab the file
			$file = $this->data['User']['avatar_file'];

			// upload the image using the upload component
			$result = $this->Upload->upload($file, $destination, null, array('type' => 'resizecrop', 'size' => array('80', '80'), 'output' => 'jpg'));
				
			if (!$result)
			{
				$this->data['User']['avatar_url'] = '/img/uploads/avatars/' . $this->Upload->result;


				if ($this->User->save($this->data, false))
				{
					$this->Session->setFlash(__('The Image has been uploaded', true));
					$this->redirect(array('controller'=>'users','action'=>'edit', $id));
					exit();
				}
				else
				{
					$this->Session->setFlash((__('Could\'nt upload the image', true)));
					$this->redirect(array('controller'=>'users','action'=>'edit', $id));
					exit();
				}
					
			}
			else
			{
				// display error
				$errors = $this->Upload->errors;

				// piece together errors
				if(is_array($errors)){ $errors = implode(", ",$errors); }

				$this->Session->setFlash($errors);
				$this->redirect(array('controller'=>'users','action'=>'edit', $id));
				exit();
			}
				

		}
	}

	function index() {
		//$this->User->recursive = 0;
		$this->set('users', $this->paginate());
		//$this->redirect('/');
	}

	function view($id = null) {

		if (!$id) {
			$this->Session->setFlash(__('Invalid User.', true));
			$this->redirect('/');
		}

		$this->User->bindModel(array('hasOne'=>array (
			'Userdetail' => array('className' => 'Userdetail',
								'foreignKey' => 'user_id')
		)));

		$this->User->bindModel(array('hasMany'=>array (
			'Usercomment' => array('className' => 'Usercomment',
								'foreignKey' => 'user_id',
			
		)
		)));
			
		$result = $this->User->read(null, $id);

		$i = 0;
		if (!empty($result['Team']))
		{
			foreach ($result['Team'] as $team)
			{
				if ($team['type'] == 'solo')
				unset($result['Team'][$i]);
				$i++;
			}
		}

		if(isset($this->params['requested'])) {
			return $result;
		}
		else
		{

			$comments = $this->paginate('Usercomment', array('user_id' => $id));
			$this->set('comments', $comments);
			$this->titleForContent = '<b>'. $result['User']['username'] . '</b>';
			$this->set('user', $result);
			$uniqueIds = $this->User->Uniqueid->findAll(array('user_id' => $result['User']['id']));
			$this->set('uniqueids', $uniqueIds);
				
		}

	}

	function loginbox($id = null) {

		if (!$id) {
			$this->Session->setFlash(__('Invalid User.', true));
			$this->redirect('/');
		}

		//$this->User->unbindAll( array ( 'hasMany' => array ('Team'), 'hasAndBelongsToMany' => array('Organization', 'Clan') ) );
		$result = $this->User->read(null, $id);

		$i = 0;
		if (!empty($result['Team']))
		{
			foreach ($result['Team'] as $team)
			{
				if ($team['type'] == 'solo')
				unset($result['Team'][$i]);
				$i++;
			}
		}

		if(isset($this->params['requested'])) {
			return $result;
		}
		else
		{
			$this->layout = 'ajax';
			$this->set('user', $result);
		}

	}

	function register() {
		if (!empty($this->data)) {
			$this->data["User"]["passwd"] = md5($this->data["User"]["password"]);
			$this->data["User"]["name"] = $this->data["User"]["username"];
			$this->data["User"]["group_id"] = 3;
			$this->data["User"]["active"] = 1;
			$this->data["User"]["points"] = 1000;
				

			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been registered. You can now login.', true));
				$this->redirect(array("action" => "login"));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));

			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
		$this->titleForContent = __('Register', true);
	}

	function addcomment()
	{
		if (!empty($this->data)) {
			$this->data['Usercomment']['user_id'] = $this->othAuth->user('id');

			$this->User->Usercomment->create();
			if ($this->User->Usercomment->save($this->data)) {
				$this->Session->setFlash(__('Comment has been submited', true));
			} else {
				$this->Session->setFlash(__('Error occured', true));
			}
			$this->redirect(array('action'=>'view', $this->data['Usercomment']['user_id']));
			exit();
		}
	}

	function edit($id = null) {

		
		if ($id != $this->othAuth->user('id') || (!empty($this->data["User"]["id"]) && $this->othAuth->user('id') != $this->data["User"]["id"]))
		{
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect($this->referer(null));
		}

		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
		}


		if (!empty($this->data)) {

			//	We dont want users hacking their username due to different validation on edit form

			unset($this->data["User"]["username"]);
				
			if (strlen($this->data["User"]["new_passwd"]) > 0)
			$this->data["User"]["passwd"] = md5($this->data["User"]["new_passwd"]);
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'edit', $id));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}

		$this->User->bindModel(array('hasOne'=>array (
			'Userdetail' => array('className' => 'Userdetail', 'foreignKey' => 'user_id')
		)));		
		
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
			//$this->set('uniqueids', $this->data['User']['Uniqueid']);
			$this->set('user', $this->data);
			$this->set('userdetail', $this->data['Userdetail']);			
		}
		else
		{
			$user = $this->User->read(null, $this->data['User']['id']);
			$this->set('user', $this->data);
			$this->set('userdetail', $user['Userdetail']);
			$this->data['Userdetail'] = $user['Userdetail'];
		}


		
		$games = $this->User->Team->Game->find('list');
		$this->set(compact('games'));

		$uniqueIds = $this->User->Uniqueid->findAll(array('user_id' => $id));
		$this->set('uniqueids', $uniqueIds);

		$this->titleForContent = '<b>' . __('Edit my profile', true) . '</b>';
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->del($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}


	function admin_index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid User.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->data["User"]["passwd"] = md5($this->data["User"]["passwd"]);
				
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if (strlen($this->data["User"]["new_passwd"]) > 0)
			$this->data["User"]["passwd"] = md5($this->data["User"]["new_passwd"]);
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->del($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>