<?php
App::uses('AppController', 'Controller');

class OrganizationsController extends AppController {

	public $uses = array('Organization', 'Subscription');

	public function beforeFilter() {
		$this->response->type('json');
    	$this->autoRender = false;
	}

	public function subscriptions($id = null) {
		if (!$this->Organization->exists($id)) {
			echo json_encode(array('status' => 'Organization with id:' . $id . ' does not exist.'));
		} else {
			$options = array('conditions' => array('Organization.' . $this->Organization->primaryKey => $id));
			$result = $this->Organization->find('first', $options);

			$subscriptions = array('conditions' => array('Subscription.organization_id' => $id));
			$subscriptions = $this->Subscription->find('all', $subscriptions);

			$result['Organization']['Subscriptions'] = Set::extract('/Subscription/.', $subscriptions);

	        echo json_encode($result['Organization']);
        }
	}

}
