<?php

App::uses('AppModel', 'Model');

/**
 * Factory Model
 *
 * @property Tag $Tag
 */
class Factory extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';
    
    var $actsAs = array(
        'Geocode.Geocodable',
    );


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Tag' => array(
            'className' => 'Tag',
            'joinTable' => 'factories_tags',
            'foreignKey' => 'factory_id',
            'associationForeignKey' => 'tag_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );
    
    public function find($conditions = null, $fields = array(), $order = null, $recursive = null) {
        $findMethods = array_merge($this->findMethods, array('near' => true));
        $findType = (is_string($conditions) && $conditions != 'count' && array_key_exists($conditions, $findMethods) ? $conditions : null);
        if (empty($findType) && is_string($conditions) && $conditions == 'count' && !empty($fields['type']) && array_key_exists($fields['type'], $findMethods)) {
            $findType = $fields['type'];
            unset($fields['type']);
        }

        if ($findType == 'near' && $this->Behaviors->enabled('Geocodable')) {
            $type = ($conditions == 'near' ? 'all' : $conditions);
            $query = $fields;
            if (!empty($query['address'])) {
                foreach (array('address', 'unit', 'distance') as $field) {
                    $$field = isset($query[$field]) ? $query[$field] : null;
                    unset($query[$field]);
                }
                return $this->near($type, $address, $distance, $unit, $query);
            }
        }
        return parent::find($conditions, $fields, $order, $recursive);
    }

}
