<?php
/**
 * FactoriesTagFixture
 *
 */
class FactoriesTagFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'factory_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 8, 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'tag_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => true),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8mb4', 'collate' => 'utf8mb4_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'factory_id' => 'Lorem ',
			'tag_id' => 1
		),
	);

}
