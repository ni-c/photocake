<?php
App::uses('AppModel', 'Model');
/**
 * Option Model
 *
 */
class Option extends AppModel {

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
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Key should be unique',
                'required' => true,
                'on' => 'create',
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
            ), ),
    );
}
