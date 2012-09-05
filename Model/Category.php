<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property Photo $Photo
 */
class Category extends AppModel {

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
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Name should be unique',
                'required' => true,
                'on' => 'create',
            ),
            'maxLength' => array(
                'rule' => array(
                    'maxLength',
                    16
                ),
                'message' => 'Name must be no larger than 16 characters long.'
            ),
        ),
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
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'message' => 'Alphabets and numbers only'
            ),
            'maxLength' => array(
                'rule' => array(
                    'maxLength',
                    16
                ),
                'message' => 'Slug must be no larger than 16 characters long.'
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
            'foreignKey' => 'category_id',
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
