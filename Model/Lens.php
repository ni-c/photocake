<?php
App::uses('AppModel', 'Model');
/**
 * Lense Model
 *
 */
class Lens extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
		    'numeric' => array(
		        'rule'    => 'numeric',
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
		        'rule'    => array('maxLength', 32),
		        'message' => 'Name must be no larger than 32 characters long.'
		    ),
		),
	);
}
