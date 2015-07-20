<?php
/**
 * FactoryFixture
 *
 */
class FactoryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 8, 'key' => 'primary', 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'key' => 'index', 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'license_no' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 16, 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'address' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'index', 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'cunli' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 64, 'key' => 'index', 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'owner' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 32, 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'company_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 16, 'key' => 'index', 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 16, 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'date_approved' => array('type' => 'date', 'null' => false, 'default' => null),
		'date_registered' => array('type' => 'date', 'null' => false, 'default' => null, 'key' => 'index'),
		'status' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 16, 'collate' => 'utf8mb4_unicode_ci', 'charset' => 'utf8mb4'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'company_id' => array('column' => 'company_id', 'unique' => 0),
			'date_registered' => array('column' => 'date_registered', 'unique' => 0),
			'name' => array('column' => 'name', 'unique' => 0),
			'address' => array('column' => 'address', 'unique' => 0, 'length' => array('address' => '191')),
			'cunli' => array('column' => 'cunli', 'unique' => 0)
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
			'id' => 'Lorem ',
			'name' => 'Lorem ipsum dolor sit amet',
			'license_no' => 'Lorem ipsum do',
			'address' => 'Lorem ipsum dolor sit amet',
			'cunli' => 'Lorem ipsum dolor sit amet',
			'owner' => 'Lorem ipsum dolor sit amet',
			'company_id' => 'Lorem ipsum do',
			'type' => 'Lorem ipsum do',
			'date_approved' => '2015-07-21',
			'date_registered' => '2015-07-21',
			'status' => 'Lorem ipsum do'
		),
	);

}
