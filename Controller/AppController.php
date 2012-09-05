<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $uses = array('Options');

    /**
     * Returns the option value of the given key or null if not set
     *
     * @param $key The key to get the option for
     * @return The option value of the given key or null if not set
     */
    public function getOption($key) {
        $r = $this->Options->findByKey($key);
        if (isset($r['Options'])) {
            return $r['Options']['value'];
        }
        return '';
    }
	
	/**
	 * Set the default vars
	 */
    public function beforeRender() {
        $this->set('keywords', $this->isEmpty($this->getOption('keywords'), 'photocake,foto,blog'));
        $this->set('site_title', $this->isEmpty($this->getOption('site_title'), 'Photocake'));
        $this->set('site_subtitle', $this->isEmpty($this->getOption('site_subtitle'), 'Markdown Photo Blog'));
        $this->set('copyright', $this->isEmpty($this->getOption('copyright'), '&copy; 2011-2012 Willi Thiel'));
        $this->set('author', $this->isEmpty($this->getOption('author'), 'Willi Thiel'));
        $this->set('license', $this->isEmpty($this->getOption('license'), 'MIT License'));
        $this->set('lang', 'de');
    }

	/**
	 * If string is empty, the method returns default. Otherwise it returns string
	 * 
	 * @param $string The string to check
	 * @param $default The default value
	 * @return If string is empty, the method returns default. Otherwise it returns string
	 */
	private function isEmpty($string, $default) {
		if ($string == '') {
			return $default;
		}
		return $string;
	}

}
