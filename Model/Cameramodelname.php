<?php
App::uses('AppModel', 'Model');
/**
 * Cameramodelname Model
 *
 * @property Photo $Photo
 */
class Cameramodelname extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array('name' => array(
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
        ), );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array('Photo' => array(
            'className' => 'Photo',
            'foreignKey' => 'cameramodelname_id',
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
