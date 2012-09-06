<?php
App::uses('AppModel', 'Model');
/**
 * Cameramodelname Model
 *
 * @property Photo $Photo
 */
class Cameramodelname extends AppModel {

	public $recursive = -1;

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

	/**
	 * Check if an entry with the name already exists and set id
	 * 
	 * @param $options The options
	 */
	public function beforeValidate(array $options = array()) {
		$cameramodelname = $this->findByName($this->data['Cameramodelname']['name']);
		if ($cameramodelname!==false) {
			$this->data['Cameramodelname']['id'] = $cameramodelname['Cameramodelname']['id'];
		}
		return true;
	}

}
