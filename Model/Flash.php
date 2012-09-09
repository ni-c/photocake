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
 * Flash Model
 *
 * @property Photo $Photo
 */
class Flash extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'id' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Numbers only'
            ),
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Name should not be empty',
                'allowEmpty' => false,
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Id should be unique',
                'required' => true,
                'on' => 'create',
            ),
        ),
        'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Name should not be empty',
                'allowEmpty' => false,
            ),
            'maxLength' => array(
                'rule' => array(
                    'maxLength',
                    128
                ),
                'message' => 'Name must be no larger than 128 characters long.'
            ),
        ),
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array('Photo' => array(
            'className' => 'Photo',
            'foreignKey' => 'flash_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ));

}
