<?php
App::uses('AppModel', 'Model');
/**
 * Option Model
 *
 */
class Option extends AppModel {

    public $recursive = -1;

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
            ), 
		),
    );

    /**
     * Check if an entry with the slug already exists and set id
     *
     * @param $options The options
     */
    public function beforeValidate(array $options = array()) {
        $option = $this->findByKey($this->data['Option']['key']);
        if ($option !== false) {
            $this->data['Option']['id'] = $option['Option']['id'];
        }
        return true;
    }

}
