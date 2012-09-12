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

App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property User $User
 */
class User extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'username' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required',
                'required' => true,
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This username has already been taken.',
            ),
            'between' => array(
                'rule' => array(
                    'between',
                    3,
                    15
                ),
                'required' => true,
                'message' => 'Username must be between 5 and 15 characters long.',
            ),
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'message' => 'Alphabets and numbers only'
            ),
        ),
        'password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required',
                'required' => true,
            ),
            'between' => array(
                'rule' => array(
                    'between',
                    5,
                    64
                ),
                'message' => 'Password must be between 5 and 64 characters long.',
            )
        ),
        'passwordcheck' => array('identical' => array(
                'rule' => array(
                    'identical',
                    'password'
                ),
                'message' => 'Passwords do not match',
            )),
        'role' => array('valid' => array(
                'rule' => array(
                    'inList',
                    array(
                        'Admin',
                        'Editor',
                        'Author'
                    )
                ),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            ))
    );

    public function beforeSave($options = array()) {
        // Password hashing
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        if (isset($this->data[$this->alias]['passwordcheck'])) {
            $this->data[$this->alias]['passwordcheck'] = AuthComponent::password($this->data[$this->alias]['passwordcheck']);
        }
        return true;
    }

}
