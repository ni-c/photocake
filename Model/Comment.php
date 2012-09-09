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
 * Comment Model
 *
 * @property Photo $Photo
 */
class Comment extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'photo_id' => array('numeric' => array('rule' => array('numeric'),
                'message' => 'Your custom message here',
                'allowEmpty' => false,
                'required' => true,
            ), ),
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'allowEmpty' => false,
                'required' => true,
                'message' => 'Please enter a name',
            ),
            'maxLength' => array(
                'rule' => array(
                    'maxLength',
                    32
                ),
                'message' => 'Name must be no larger than 32 characters long.'
            ),
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Please enter a valid Email',
                'allowEmpty' => false,
                'required' => true,
            ),
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Email required',
                'allowEmpty' => false,
            ),
            'maxLength' => array(
                'rule' => array(
                    'maxLength',
                    32
                ),
                'message' => 'Email must be no larger than 32 characters long.'
            ),
        ),
        'website' => array('notempty' => array(
                'rule' => 'url',
                'message' => 'Website should be a valid URL',
                'allowEmpty' => true,
            ), ),
        'comment' => array('notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Name should not be empty',
                'allowEmpty' => false,
            ), ),
    );

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array('Photo' => array(
            'className' => 'Photo',
            'foreignKey' => 'photo_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ));
}
