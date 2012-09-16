<?php
/**
 * photocake - A markdown photo blog based on CakePHP.
 * Copyright (C) 2012 Willi Thiel <mail@willithiel.de>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @copyright     Copyright 2012, Willi Thiel <mail@willithiel.de>
 * @link          https://github.com/ni-c/photocake
 * @license       GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 */

App::uses('Controller', 'Controller');
/**
 * App Controller
 *
 * @property App $App
 */
class AppController extends Controller {

    public $uses = array('Options');

    public $components = array(
        'Cookie',
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'photos',
                'action' => 'view',
                'last'
            ),
            'logoutRedirect' => array(
                'controller' => 'photos',
                'action' => 'view',
                'last'
            ),
            'authorize' => array('Controller')
        ),
        'RequestHandler' => array('checkHttpCache' => true)
    );

    public $helpers = array(
        'Cache',
        'Html' => array('className' => 'LanguageHtml')
    );

    public $available_languages = array(
        'en' => array(
            'name' => 'English',
            'english_name' => 'English',
            'alt' => 'Switch to english',
            'default' => false
        ),
        'de' => array(
            'name' => 'Deutsch',
            'english_name' => 'German',
            'alt' => 'Webseite auf Deutsch umschalten',
            'default' => false
        ),
    );

    /**
     * The keywords for the meta description
     */
    protected $keywords = '';

    /**
     * The description for the meta description
     */
    protected $description = '';

    /**
     * Options array
     */
    private $options = null;

    /**
     * The folder where the images and markdown files are stored
     */
    protected $parse_dir = 'Files/';

    /**
     * Returns the option value of the given key or null if not set
     *
     * @param $key The key to get the option for
     * @return The option value of the given key or null if not set
     */
    public function getOption($key) {
        $options = $this->getOptions();
        if (isset($options[$key])) {
            return $options[$key];
        }
        return '';
    }

    /**
     * Returns all Options
     */
    public function getOptions() {
        if ($this->options == null) {
            $options = Cache::read('options');
            if (!$options) {
                $options = $this->Options->find('all');
                Cache::write('options', $options);
            }
            $this->options = array();
            foreach ($options as $key => $value) {
                $this->options[$value['Options']['key']] = $value['Options']['value'];
            }
        }
        return $this->options;
    }

    /**
     * Set the language
     */
    public function beforeFilter() {
    	
       if (!file_exists(ROOT . DS . APP_DIR . DS . 'Config' . DS . 'database.php')) {
            $this->redirect('/install.php');
        }
        $this->setLanguage();
		
		$settings = Cache::read('settings');
		if (!$settings) {
			$settings = array();
	        $settings['parse_dir'] = $this->isEmpty($this->getOption('parse_dir'), 'Files/');
	        // absolute or relative path
	        if ($settings['parse_dir'][0] != DS) {
	            $settings['parse_dir'] = ROOT . DS . APP_DIR . DS . $settings['parse_dir'];
	        }
	        $settings['theme'] = $this->isEmpty($this->getOption('theme'), null);
	        $settings['keywords'] = $this->isEmpty($this->getOption('keywords'), 'photocake,foto,photo,blog,photographics,fotografie,images,bilder');
    	    $settings['description'] = $this->getOption('site_title') . ' - ' . $this->getOption('site_subtitle');
		}
		
		$this->parse_dir = $settings['parse_dir'];
		$this->keywords = $settings['keywords'];
		$this->description = $settings['description'];
		$this->theme = $settings['theme'];
				
        $this->Auth->allow('index', 'view');
        $this->set('logged_in', $this->Auth->loggedIn());
        $this->set('lang', $this->isEmpty($this->Session->read('Config.language'), 'en'));
    }

    /**
     * Set the default vars
     */
    public function beforeRender() {
        $this->set('keywords', $this->isEmpty($this->keywords, 'photocake,photoblog,fotoblog,pictureblog,photo,foto,image,picture,blog,cms'));
        $this->set('description', $this->isEmpty($this->description, 'Photocake photo blog system.'));
        $this->set('site_title', $this->isEmpty($this->getOption('site_title'), 'Photocake'));
        $this->set('site_subtitle', $this->isEmpty($this->getOption('site_subtitle'), 'Markdown Photo Blog'));
        $this->set('copyright', $this->isEmpty($this->getOption('copyright'), '&copy; 2011-2012 Willi Thiel'));
        $this->set('author', $this->isEmpty($this->getOption('author'), 'Willi Thiel'));
        $this->set('license', $this->isEmpty($this->getOption('license'), 'MIT License'));
        $this->set('ga_code', $this->isEmpty($this->getOption('ga_code'), ''));
        $this->set('na', '-');
        $this->set('rss_feed', $this->isEmpty($this->getOption('rss_feed'), ''));
        $this->set('available_languages', $this->available_languages);
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

    /**
     * Set the language
     */
    private function setLanguage() {

        if (isset($this->params['language'])) {
            $language = $this->params['language'];
        } else {
            $language = Configure::read('Config.default_language');
        }
        $this->Session->write('Config.language', $language);
        $this->available_languages[Configure::read('Config.default_language')]['default'] = true;
    }

    /*
     * override redirect
     */
    public function redirect($url, $status = NULL, $exit = true) {
        if (!isset($url['language']) && $this->Session->check('Config.language')) {
            $url['language'] = $this->Session->read('Config.language');
        }
        parent::redirect($url, $status, $exit);
    }

    /**
     * Check if user is authorized
     */
    public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['role']) && (($user['role'] === 'Admin') || ($user['role'] === 'Author') || ($user['role'] === 'Editor'))) {
            return true;
        }

        // Default deny
        return false;
    }

}
