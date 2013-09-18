<?php
App::uses('AppModel', 'Model');

class MarketingPackageItem extends AppModel {

	public $belongsTo = array(
         'MarketingPackage' => array(
            'className' =>  'MarketingPackage',
            'foreignKey' => 'marketing_package_id'
        )
    );
	public $hasOne = array(
        'Catalog' => array(
            'className' => 'Catalog',
            'dependent' => false
        )
    );

}
