<?php
App::uses('AppModel', 'Model');
/**
 * PhotosTag Model
 *
 * @property Photo $Photo
 * @property Tag $Tag
 */
class PhotosTag extends AppModel {

	public $recursive = -1;

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'photo_id' => array('numeric' => array(
                'rule' => array('numeric'),
                'message' => 'photo_id should be numeric.',
                'allowEmpty' => false,
                'required' => true,
            ), ),
        'tag_id' => array('numeric' => array(
                'message' => 'tag_id should be numeric.',
                'allowEmpty' => false,
                'required' => true,
            ), ),
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
        ),
        'Tag' => array(
            'className' => 'Tag',
            'foreignKey' => 'tag_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
