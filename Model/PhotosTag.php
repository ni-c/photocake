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
 * PhotosTag Model
 *
 * @property Photo $Photo
 * @property Tag $Tag
 */
class PhotosTag extends AppModel {

	public $recursive = -1;

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'photo_id' => array('numeric' => array(
                'rule' => array('numeric'),
                'message' => 'photo_id should be numeric.',
                'allowEmpty' => false,
                'required' => true,
            ), ),
        'tag_id' => array('numeric' => array(
                'message' => 'tag_id should be numeric.',
                'allowEmpty' => false,
                'required' => true,
            ), ),
    );

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Photo' => array(
            'className' => 'Photo',
            'foreignKey' => 'photo_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Tag' => array(
            'className' => 'Tag',
            'foreignKey' => 'tag_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
