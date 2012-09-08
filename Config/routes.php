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

 	/* Language routes */
 	Router::connect('/:language', array('controller' => 'photos', 'action' => 'view', 'last'), array('language' => '[a-z]{2}'));
	Router::connect('/:language/photo/*', array('controller' => 'photos', 'action' => 'view'), array('language' => '[a-z]{2}'));
	Router::connect('/:language/archive/category/*', array('controller' => 'photos', 'action' => 'category'), array('language' => '[a-z]{2}'));
	Router::connect('/:language/archive/date/*', array('controller' => 'photos', 'action' => 'archivedate'), array('language' => '[a-z]{2}'));
	Router::connect('/:language/archive/tag/*', array('controller' => 'photos', 'action' => 'tag'), array('language' => '[a-z]{2}'));
	Router::connect('/:language/archive/*', array('controller' => 'photos', 'action' => 'archive'), array('language' => '[a-z]{2}'));
	Router::connect('/:language/about', array('controller' => 'pages', 'action' => 'display', 'about'), array('language' => '[a-z]{2}'));
	
	/* Default routes */
	Router::connect('/', array('controller' => 'photos', 'action' => 'view', 'last'));
	Router::connect('/feed', array('controller' => 'photos', 'action' => 'rss'));
	Router::connect('/photo/*', array('controller' => 'photos', 'action' => 'view'));
	Router::connect('/archive/category/*', array('controller' => 'photos', 'action' => 'category'));
	Router::connect('/archive/date/*', array('controller' => 'photos', 'action' => 'archivedate'));
	Router::connect('/archive/tag/*', array('controller' => 'photos', 'action' => 'tag'));
	Router::connect('/archive/*', array('controller' => 'photos', 'action' => 'archive'));
	Router::connect('/about', array('controller' => 'pages', 'action' => 'display', 'about'));
	
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
