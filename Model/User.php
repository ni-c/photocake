<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property User $User
 */
class User extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'username' => array('required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )),
        'password' => array('required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            )),
        'role' => array('valid' => array(
                'rule' => array(
                    'inList',
                    array(
                        'Admin',
                        'Editor',
                        'Author'
                    )
                ),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            ))
    );

    public function beforeSave($options = array()) {
		// Password hashing
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }

}
