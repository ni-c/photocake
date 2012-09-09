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
 * Tag Model
 *
 * @property Tag $Tag
 */
class Tag extends AppModel {

	public $order = array("Tag.name" => "ASC");

	public $recursive = -1;

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
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
                    32
                ),
                'message' => 'Name must be no larger than 32 characters long.'
            ),
        ),
        'slug' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Slug should not be empty',
                'allowEmpty' => false,
            ),
            'maxLength' => array(
                'rule' => array(
                    'maxLength',
                    32
                ),
                'message' => 'Slug must be no larger than 32 characters long.'
            ),
        ),
    );

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array('Photo' => array(
            'className' => 'Photo',
            'joinTable' => 'photos_tags',
            'foreignKey' => 'tag_id',
            'associationForeignKey' => 'photo_id',
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
	 * Check if an entry with the slug already exists and set id
	 * 
	 * @param $options The options
	 */
	public function beforeValidate(array $options = array()) {
		$tag = $this->findBySlug($this->data['Tag']['slug']);
		if ($tag!==false) {
			$this->data['Tag']['id'] = $tag['Tag']['id'];
		}
		return true;
	}

}
