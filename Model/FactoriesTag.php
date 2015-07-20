<?php

App::uses('AppModel', 'Model');

/**
 * FactoriesTag Model
 *
 * @property Factory $Factory
 * @property Tag $Tag
 */
class FactoriesTag extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'id';


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'Factory' => array(
            'className' => 'Factory',
            'foreignKey' => 'factory_id',
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
