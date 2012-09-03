<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property Photo $Photo
 */
class Comment extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'photo_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
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
		    'maxLength' => array(
		        'rule'    => array('maxLength', 32),
		        'message' => 'Name must be no larger than 32 characters long.'
		    ),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Email should be valid',
				'allowEmpty' => false,
				'required' => true,
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
		    'maxLength' => array(
		        'rule'    => array('maxLength', 32),
		        'message' => 'Email must be no larger than 32 characters long.'
		    ),
		),
		'website' => array(
			'notempty' => array(
 				'rule' => 'url',
				'message' => 'Website should be a valid URL',
				'allowEmpty' => false,
				'required' => true,
			),
		),
		'comment' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'required' => true,
				'message' => 'Name should not be empty',
				'allowEmpty' => false,
			),
		),
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
		)
	);
}
