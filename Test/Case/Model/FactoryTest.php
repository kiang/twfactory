<?php
App::uses('Factory', 'Model');

/**
 * Factory Test Case
 *
 */
class FactoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.factory',
		'app.tag',
		'app.factories_tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Factory = ClassRegistry::init('Factory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Factory);

		parent::tearDown();
	}

}
