<?php
App::uses('AppModel', 'Model');
/**
 * Tag Model
 *
 * @property Photo $Photo
 */
class Tag extends AppModel {

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
		        'rule'    => array('maxLength', 16),
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
		    'maxLength' => array(
		        'rule'    => array('maxLength', 16),
		        'message' => 'Slug must be no larger than 16 characters long.'
		    ),
		),
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Photo' => array(
			'className' => 'Photo',
			'joinTable' => 'photos_tags',
			'foreignKey' => 'tag_id',
			'associationForeignKey' => 'photo_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
