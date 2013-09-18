<?php
App::uses('AppController', 'Controller');

class OrganizationsController extends AppController {

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
	        echo json_encode($result['Organization']);
        }
	}
