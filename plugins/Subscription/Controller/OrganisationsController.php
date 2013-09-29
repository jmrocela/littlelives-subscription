<?php
App::uses('AppController', 'Controller');

class OrganisationsController extends SubscriptionAppController {

	public $uses = array('Subscription.Organisation', 'Subscription.Subscription', 'Subscription.Catalog');

	public function beforeFilter() {
		$this->response->type('json');
    	$this->autoRender = false;
	}

	public function subscriptions($id = null) {
		if (!$this->Organisation->exists($id)) {
			echo json_encode(array('status' => 'Organisation with id:' . $id . ' does not exist.'));
		} else {
			$options = array('conditions' => array('Organisation.' . $this->Organisation->primaryKey => $id));
			$result = $this->Organisation->find('first', $options);

			$parents = $this->Organisation->query('SELECT id, GetAncestry(id) as parents from organisations where id = ' . $id);
			$parents = ($parents[0][0]['parents']) ? explode(',', $parents[0][0]['parents']): array();

			$organisations = $this->Organisation->query('SELECT * FROM littlelives.organisation_subscriptions WHERE id in (' . implode(',', $parents) . ')');
	        $subscriptions = Set::extract('/organisation_subscriptions/catalogs_id/.', $organisations);

			$options = array('conditions' => array('Catalog.id' => array_values($subscriptions)));
			$subscriptions = $this->Catalog->find('all', $options);
	        $subscriptions = Set::extract('/Catalog/.', $subscriptions);

			$result['Organisation']['Subscriptions'] = $subscriptions;

	        echo json_encode($result['Organisation']);
        }
	}

}
