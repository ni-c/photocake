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

App::uses('AppController', 'Controller');
/**
 * Pages Controller
 *
 * Serves static content
 *
 * @property Pages $Pages
 */
class PagesController extends AppController {

    /**
     * Controller name
     *
     * @var string
     */
    public $name = 'Pages';

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array();

    /**
     * Before filter
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('display');
    }

    /**
     * Caching enabled
     */
    public $cacheAction = array(
        'display' => array('callbacks' => true, 'duration' => '1 day'),
    );

    /**
     * Displays a view
     *
     * @param mixed What page to display
     * @return void
     */
    public function display() {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            $this->redirect('/');
        }
        $page = $subpage = $title_for_layout = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        if (!empty($path[$count - 1])) {
            $title_for_layout = Inflector::humanize($path[$count - 1]);
        }
        $this->set(compact('page', 'subpage', 'title_for_layout'));

        if ($path[0] == 'about') {
        	$this->about();
        }

        $this->render(implode('/', $path));
    }

    private function about() {
        // Check for about image
        if (!file_exists(ROOT . DS . APP_DIR . DS . 'webroot' . DS . 'img' . DS . 'm' . DS . 'about.jpg')) {
            $this->set('missing_image', 1);
        }

        // Check for about markdown file in current language
        $about = $this->loadfile($this->parse_dir . 'about.' . $this->params['language'] . '.md');
        if ($about === false) {
            // Check for general about markdown file
            $about = $this->loadfile($this->parse_dir . 'about.md');
        }
        if ($about !== false) {
            $this->set('about', $about);
        }

        $this->TagCloud = $this->Components->load('TagCloud');
        $this->set('cloud', $this->TagCloud->generateCloud());
    }

    private function loadfile($file) {
        if (file_exists($file)) {
            $content = implode("\n", file($file));
            return $content;
        } else {
        	return false;
        }
    }

}
