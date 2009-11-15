<?php
/* SVN FILE: $Id: app_controller.php 6311 2008-01-02 06:33:52Z phpnut $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.app
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 6311 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-02 00:33:52 -0600 (Wed, 02 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for class.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		cake
 * @subpackage	cake.app
 */
class AppController extends Controller {

	var $components  = array('othAuth', 'P28n', 'Session');
	var $helpers = array('Html', 'Form', 'OthAuth');
	var $usesModels = array('Langs');

	var $othAuthRestrictions = array( 'add', 'edit', 'delete', 'sign', 'promote', 'admin_add', 'admin_index', 'admin_edit', 'admin_delete', 'admin_view' );

	var $userLangCode = '';
	var $userId = null;
	var $titleForContent = '';
	var $contentFullFill = false;
	var $viewHelpers = array ();
	var $contentHelpers = array();


	function beforeFilter()
	{
		 
		//	language
		$this->P28n->startup();
		$this->userLangCode = $this->P28n->get();

		//	authentication

		$dirs = explode('/', $_GET['url'], 2);

		$auth_conf = array(
                    'mode'  => 'oth',
                    'login_page'  => '/users/login',
                    'logout_page' => '/users/logout',
                    'access_page' => '/',
                    'hashkey'     => 'skyGamesHazhkey',
                    'noaccess_page' => '/users/login',
                    'strict_gid_check' => false);

		 
		$this->allowedAssocUserModels = array('hasMany'=>array('Team'));
		$this->othAuth->controller = &$this;


		$this->othAuth->init($auth_conf);
		$this->othAuth->check();

		$this->userId = $this->othAuth->user('id');

		//	layout
		 
		if( $dirs[0] == 'admin' && $this->othAuth->group("level") >= 300) {
			$this->layout = 'admin';
		}
		else
		$this->layout = 'skygames';


		$this->titleForContent =  '<b>'.__($this->name, true) . '</b>';
	}


	function beforeRender()
	{
		$this->set('user_name', $this->othAuth->user("name"));
		$this->set('user_lastvisit', $this->othAuth->user("last_visit"));
		$this->set('title_for_content',$this->titleForContent);
		$this->set('content_full_fill', $this->contentFullFill);
		$this->set('content_helpers', $this->contentHelpers);
		$this->set('userId', $this->userId);

	}


	function formatFilterConditions($searchParams = array())
	{
		$conditions = array();
		if (!empty($searchParams))
		{
			foreach ($searchParams as $param)
			{
				if (!empty($this->data['Event'][$param]))
				$conditions[$param] = $this->data['Event'][$param];
				elseif (!empty($this->params['named'][$param]))
				{
					$this->data['Event'][$param] = $this->params['named'][$param];
					$conditions[$param] = $this->params['named'][$param];
				}
			}
			return $conditions;
		}
		else
		return null;
	}

}
?>