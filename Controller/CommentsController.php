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
 * Comments Controller
 *
 * @property Comment $Comment
 */
class CommentsController extends AppController {

    var $components = array('Defensio');

    /**
     * Before filter
     */
    public function beforeFilter() {
        parent::beforeFilter();
        // Everybody is allowed to add comments
        $this->Auth->allow('add');
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {

        if ($this->request->is('post')) {
            $this->Comment->create();
            $api_key = $this->getOption('defensio_apikey');
            if (($api_key == '') || ($this->Defensio->check($api_key, $this->request->data['Comment']['comment'], $this->request->data['Comment']['name'], $this->request->data['Comment']['email'], $this->request->data['Comment']['website']))) {
                if ($this->Comment->save($this->request->data)) {
                    $this->Session->setFlash(__('The comment has been saved'));
                } else {
                    $this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
                }
            }
        }
        $this->redirect($this->referer());
    }

}
