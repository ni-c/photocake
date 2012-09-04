<?php
App::uses('AppModel', 'Model');
/**
 * Flash Model
 *
 * TIFF Tag Flash
 * IFD		Exif
 * Code		37385 (hex 0x9209)
 * Name		Flash
 * Type		SHORT
 * Count	1
 * Default	None
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
