<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

 	/* Create routes array */
	$routes = array(
		array('', array('controller' => 'photos', 'action' => 'view', 'last')),
		array('photo/*', array('controller' => 'photos', 'action' => 'view')),
		array('archive/category/*', array('controller' => 'photos', 'action' => 'category')),
		array('archive/date/*', array('controller' => 'photos', 'action' => 'archivedate')),
		array('archive/tag/*', array('controller' => 'photos', 'action' => 'tag')),
		array('archive/*', array('controller' => 'photos', 'action' => 'archive')),
		array('about', array('controller' => 'pages', 'action' => 'display', 'about')),
		array('login', array('controller' => 'users', 'action' => 'login')),
		array('logout', array('controller' => 'users', 'action' => 'logout')),
		array('admin', array('controller' => 'admins', 'action' => 'index')),
		array('admin/:action/*', array('controller' => 'admins')),
	);

	/* Parse route array and connect language routes */
	foreach ($routes as $key => $route) {
		Router::connect("/:language" . (($route[0]!='') ? ('/' . $route[0]) : '') , $route[1], array('language' => '[a-z]{2}'));
		Router::connect("/" . $route[0], $route[1]);
	}
 	
 	/* Parse file extensions */
 	Router::parseExtensions('rss','xml','txt'); 
			
/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
