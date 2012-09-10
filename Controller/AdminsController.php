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
 * Admin Controller
 *
 * @property Admin $Admin
 */
class AdminsController extends AppController {

	public $name = 'Admin';

    public $uses = array('Option');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->deny();
	}

	public function index() {
		
	}

    public function settings() {
        if ($this->request->is('post')) {
        	foreach ($this->request->data['Admin'] as $key => $value) {
        		$option = $this->Option->findByKey($key);
				if ($option) {
					$this->Option->save(array('Option' => array('id' => $option['Option']['id'], 'key' => $key, 'value' => $value)));
				} else {
					$this->Option->save(array('Option' => array('key' => $key, 'value' => $value)));
				}
			}
		}
        $this->set('options', $this->getOptions());
    }

}
