<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property Photo $Photo
 */
class Category extends AppModel {

	public $order = array("Category.name" => "ASC");

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

	/**
	 * Check if an entry with the slug already exists and set id
	 * 
	 * @param $options The options
	 */
	public function beforeValidate(array $options = array()) {
		$category = $this->findBySlug($this->data['Category']['slug']);
		if ($category!==false) {
			$this->data['Category']['id'] = $category['Category']['id'];
		}
		return true;
	}

}
