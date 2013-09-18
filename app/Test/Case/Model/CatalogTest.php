<?php
App::uses('Catalog', 'Model');

/**
 * Catalog Test Case
 *
 */
class CatalogTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.catalog',
		'app.product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Catalog = ClassRegistry::init('Catalog');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Catalog);

		parent::tearDown();
	}

}
