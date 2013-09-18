<?php
App::uses('AppModel', 'Model');

class MarketingPackage extends AppModel {

	public $displayField = 'name';

	public $hasMany = array(
		'MarketingPackageItem' => array(
            'className' => 'MarketingPackageItem',
            'foreignKey' => 'marketing_package_id'
        )
	);
}
