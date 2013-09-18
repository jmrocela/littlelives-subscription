<?php
App::uses('AppModel', 'Model');

class Organization extends AppModel {

	public $displayField = 'name';

	public $hasAndBelongsToMany = array(
		'MemberOf' => array(
            'className' => 'Organization',
            'associationForeignKey' => 'id',
            'foreignKey' => 'parent_id'
        )
	)

}
