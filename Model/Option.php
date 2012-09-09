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
 * Option Model
 *
 */
class Option extends AppModel {

    public $recursive = -1;

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'key' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Key should not be empty',
                'allowEmpty' => false,
            ),
            'maxLength' => array(
                'rule' => array(
                    'maxLength',
                    32
                ),
                'message' => 'Key must be no larger than 32 characters long.'
            ),
        ),
        'value' => array('maxLength' => array(
                'rule' => array(
                    'maxLength',
                    255
                ),
                'message' => 'Value must be no larger than 255 characters long.'
            ), 
		),
    );

    /**
     * Check if an entry with the slug already exists and set id
     *
     * @param $options The options
     */
    public function beforeValidate(array $options = array()) {
        $option = $this->findByKey($this->data['Option']['key']);
        if ($option !== false) {
            $this->data['Option']['id'] = $option['Option']['id'];
        }
        return true;
    }

}
