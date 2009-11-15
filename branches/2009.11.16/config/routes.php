<?php
/* SVN FILE: $Id: routes.php 6311 2008-01-02 06:33:52Z phpnut $ */
/**
 * Short description for file.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @subpackage		cake.app.config
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 6311 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-02 00:33:52 -0600 (Wed, 02 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.thtml)...
 */
Router::connect('/', array('controller' => 'infos', 'action' => 'index'));

Router::connect('/webroot/forum/users/*', '/users');

/**
 * Then we connect url '/test' to our test controller. This is helpfull in
 * developement.
 */

//Router::connect('/event/*', array('controller' => 'events', 'action' => 'view'));

Router::connect('/event/([\d]+):(.+)', array('controller' => 'events', 'action'=>'view'));

Router::connect('/match/([\d]+):(.+)', array('controller' => 'matches', 'action'=>'view'));

Router::connect('/info/([\d]+):(.+)', array('controller' => 'infos', 'action'=>'view'));

Router::connect('/lang/*', array('controller' => 'locales', 'action' => 'change'));

//forgiving routes that allow users to change the lang of any page
Router::connect('/v2/eng?/*', array(
	    'controller' => "locales",
	    'action' => "shuntRequest",
	    'lang' => 'eng'
	    ));

	    Router::connect('/v2/lit?/*', array(
	    'controller' => "locales",
	    'action' => "shuntRequest",
	    'lang' => 'lit'
	    ));

	    Router::connect('/lv?/*', array(
	    'controller' => "locales",
	    'action' => "shuntRequest",
	    'lang' => 'lva'
	    ));
	    ?>