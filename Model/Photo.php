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
 * Photo Model
 *iCameramodelname $Cameramodelname
 * @property Flash $Flash
 * @property Lens $Lens
 * @property Exposureprogram $Exposureprogram
 * @property Meteringmode $Meteringmode
 * @property Comment $Comment
 * @property Tag $Tag
 */
class Photo extends AppModel {

	public $order = array("Photo.datecreated" => "DESC");
    
    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'category_id' => array('numeric' => array(
                'rule' => array('numeric'),
                'message' => 'category_id should be numeric',
                'allowEmpty' => true,
            ), ),
        'cameramodelname_id' => array('numeric' => array(
                'rule' => array('numeric'),
                'message' => 'cameramodel_id should be numeric',
                'allowEmpty' => true,
            ), ),
        'flash_id' => array('numeric' => array(
                'rule' => array('numeric'),
                'message' => 'flash_id should be numeric',
                'allowEmpty' => true,
            ), ),
        'lens_id' => array('numeric' => array(
                'rule' => array('numeric'),
                'message' => 'lens_id should be numeric',
                'allowEmpty' => true,
            ), ),
        'exposureprogram_id' => array('numeric' => array(
                'rule' => array('numeric'),
                'message' => 'exposureprogram_id should be numeric',
                'allowEmpty' => true,
            ), ),
        'meteringmode_id' => array('numeric' => array(
                'rule' => array('numeric'),
                'message' => 'meteringmode_id should be numeric',
                'allowEmpty' => true,
            ), ),
        'slug' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Slug should not be empty',
                'allowEmpty' => false,
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Slug should be unique',
                'required' => true,
                'on' => 'create',
            ),
            'maxLength' => array(
                'rule' => array(
                    'maxLength',
                    255
                ),
                'message' => 'Slug must be no larger than 255 characters long.'
            ),
        ),
        'filename' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Filename should not be empty',
                'allowEmpty' => false,
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Filename should be unique',
                'required' => true,
                'on' => 'create',
            ),
            'maxLength' => array(
                'rule' => array(
                    'maxLength',
                    255
                ),
                'message' => 'Filename must be no larger than 255 characters long.'
            ),
        ),
        'title' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Title should not be empty',
                'allowEmpty' => false,
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Title should be unique',
                'required' => true,
                'on' => 'create',
            ),
            'maxLength' => array(
                'rule' => array(
                    'maxLength',
                    80
                ),
                'message' => 'Title must be no larger than 80 characters long.'
            ),
        ),
        'datecreated' => array('datetime' => array(
                'rule' => array('datetime'),
                'message' => 'Datecreated should be a datetime',
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
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'category_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Cameramodelname' => array(
            'className' => 'Cameramodelname',
            'foreignKey' => 'cameramodelname_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Flash' => array(
            'className' => 'Flash',
            'foreignKey' => 'flash_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Lens' => array(
            'className' => 'Lens',
            'foreignKey' => 'lens_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Exposureprogram' => array(
            'className' => 'Exposureprogram',
            'foreignKey' => 'exposureprogram_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Meteringmode' => array(
            'className' => 'Meteringmode',
            'foreignKey' => 'meteringmode_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array('Comment' => array(
            'className' => 'Comment',
            'foreignKey' => 'photo_id',
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

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array('Tag' => array(
            'className' => 'Tag',
            'joinTable' => 'photos_tags',
            'foreignKey' => 'photo_id',
            'associationForeignKey' => 'tag_id',
            'unique' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
            'deleteQuery' => '',
            'insertQuery' => ''
        ));

	/**
	 * afterSave callback
	 */
    function afterSave($created) {
        clearCache('*');
    }

}
