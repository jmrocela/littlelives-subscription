<?php
App::uses('AppModel', 'Model');
/**
 * Subscription Model
 *
 * @property Organisations $Organisations
 * @property Catalogs $Catalogs
 */
class Subscription extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'organisations_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'catalogs_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'effective_date' => array(
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Organisations' => array(
			'className' => 'Organisations',
			'foreignKey' => 'organisations_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Catalogs' => array(
			'className' => 'Catalogs',
			'foreignKey' => 'catalogs_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
