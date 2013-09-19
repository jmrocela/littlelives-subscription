<?php
App::uses('AppModel', 'Model');

class Organization extends AppModel {

	public $displayField = 'name';

	public $hasMany = 'Subscription';

}
