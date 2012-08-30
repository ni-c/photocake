<?php
App::uses('AppModel', 'Model');
/**
 * Photo Model
 *
 * @property Category $Category
 * @property Cameramodelname $Cameramodelname
 * @property Flash $Flash
 * @property Lens $Lens
 * @property Exposureprogram $Exposureprogram
 * @property Meteringmode $Meteringmode
 * @property Comment $Comment
 * @property Tag $Tag
 */
class Photo extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'category_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'datecreated' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
	public $hasMany = array(
		'Comment' => array(
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
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Tag' => array(
			'className' => 'Tag',
			'joinTable' => 'photos_tags',
			'foreignKey' => 'photo_id',
			'associationForeignKey' => 'tag_id',
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
