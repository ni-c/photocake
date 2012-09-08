<?php
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
