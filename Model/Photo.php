<?php
App::uses('AppModel', 'Model');
/**
 * Photo Model
 *iCameramodelname $Cameramodelname
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
        'category_id' => array('numeric' => array(
                'rule' => array('numeric'),
                'message' => 'category_id should be numeric',
                'allowEmpty' => true,
            ), ),
        'cameramodelname_id' => array('numeric' => array(
                'rule' => array('numeric'),
                'message' => 'cameramodel_id should be numeric',
                'allowEmpty' => true,
            ), ),
        'flash_id' => array('numeric' => array(
                'rule' => array('numeric'),
                'message' => 'flash_id should be numeric',
                'allowEmpty' => true,
            ), ),
        'lens_id' => array('numeric' => array(
                'rule' => array('numeric'),
                'message' => 'lens_id should be numeric',
                'allowEmpty' => true,
            ), ),
        'exposureprogram_id' => array('numeric' => array(
                'rule' => array('numeric'),
                'message' => 'exposureprogram_id should be numeric',
                'allowEmpty' => true,
            ), ),
        'meteringmode_id' => array('numeric' => array(
                'rule' => array('numeric'),
                'message' => 'meteringmode_id should be numeric',
                'allowEmpty' => true,
            ), ),
        'filename' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Filename should not be empty',
                'allowEmpty' => false,
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Filename should be unique',
                'required' => true,
                'on' => 'create',
            ),
            'maxLength' => array(
                'rule' => array(
                    'maxLength',
                    255
                ),
                'message' => 'Filename must be no larger than 255 characters long.'
            ),
        ),
        'title' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                'required' => true,
                'message' => 'Title should not be empty',
                'allowEmpty' => false,
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Title should be unique',
                'required' => true,
                'on' => 'create',
            ),
            'maxLength' => array(
                'rule' => array(
                    'maxLength',
                    80
                ),
                'message' => 'Title must be no larger than 80 characters long.'
            ),
        ),
        'datecreated' => array('datetime' => array(
                'rule' => array('datetime'),
                'message' => 'Datecreated should be a datetime',
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
    public $hasMany = array('Comment' => array(
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
        ));

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array('Tag' => array(
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
        ));

}
