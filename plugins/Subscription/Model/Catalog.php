<?php
App::uses('AppModel', 'Model');

class Catalog extends AppModel {

	public $displayField = 'id';

	public $hasMany = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'catalog_id'
        )
    );

	public $validate = array(
		'id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
