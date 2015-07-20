<?php
App::uses('FactoriesTag', 'Model');

/**
 * FactoriesTag Test Case
 *
 */
class FactoriesTagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.factories_tag',
		'app.factory',
		'app.tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FactoriesTag = ClassRegistry::init('FactoriesTag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FactoriesTag);

		parent::tearDown();
	}

}
