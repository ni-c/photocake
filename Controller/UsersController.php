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
 * User Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    /**
     * Before filter
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'logout', 'add');
    }

    /**
     * User login
     */
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Invalid username or password, try again'));
            }
        }
    	if ($this->User->find('count')==0) {
    		$this->redirect(array('controller' => 'users', 'action' => 'add'));
    	}
    }

	/**
	 * Create 
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->save($this->request->data);
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
	}

	/**
	 * Change password
	 */
	public function changepassword() {

		if ($this->request->data['User']['password'] == $this->request->data['User']['passwordrepeat']) {
			$user = $this->Auth->user();
			$User = array();
			$User = $this->User->findById($user[id]);
			$User['User']['password'] = $this->request->data['User']['password'];
            if ($this->User->save($User)) {
                $this->Session->setFlash(__('Your password has been changed'));
            } else {
                $this->Session->setFlash(__('Your password could not be saved. Please, try again.'));
            }
		} else {
	        $this->Session->setFlash(__('Passwords didn\'t match.'));
		}
        $this->redirect($this->referer());
	}

    /**
     * User logout
     */
    public function logout() {
        $this->redirect($this->Auth->logout());
    }

}
