<?php

App::uses('AppModel', 'Model');

/**
 * Tag Model
 *
 * @property Factory $Factory
 */
class Tag extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    
    public $actsAs = array('Tree');


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Factory' => array(
            'className' => 'Factory',
            'joinTable' => 'factories_tags',
            'foreignKey' => 'tag_id',
            'associationForeignKey' => 'factory_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );

}
