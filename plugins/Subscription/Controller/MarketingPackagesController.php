<?php
App::uses('AppController', 'Controller');

class MarketingPackagesController extends SubscriptionAppController {

	public $uses = array('Subscription.MarketingPackage');

	public function beforeFilter() {
		$this->response->type('json');
    	$this->autoRender = false;
	}

	public function index() {
    	$result = $this->MarketingPackage->find('all');
        echo json_encode($result);
        //echo json_encode(Set::extract('/MarketingPackage/.', $result));
	}

	public function view($id = null) {
		if (!$this->MarketingPackage->exists($id)) {
			echo json_encode(array('status' => 'MarketingPackage with id:' . $id . ' does not exist.'));
		} else {
			$options = array('recursive' => 1, 'conditions' => array('MarketingPackage.' . $this->MarketingPackage->primaryKey => $id));
			$result = $this->MarketingPackage->find('all', $options);
	        echo json_encode($result);
        }
	}

	public function add() {
    	$status = array('status' => 'FAILED');

		if ($this->request->is('post')) {
			$this->MarketingPackage->create();
			if ($this->MarketingPackage->save($this->request->data)) {
        		$status = array('status' => 'OK');
			}
		}
		echo json_encode($status);
	}

	public function edit($id = null) {
		if (!$this->MarketingPackage->exists($id)) {
			$status = array('status' => 'Invalid MarketingPackage');
		} else {
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->MarketingPackage->save($this->request->data)) {
					$status = array('status' => 'OK');
				} else {
					$status = array('status' => 'FALED');
				}
			} else {
				$options = array('conditions' => array('MarketingPackage.' . $this->MarketingPackage->primaryKey => $id));
				$this->request->data = $this->MarketingPackage->find('first', $options);
				echo json_encode($this->request->data['MarketingPackage']);
			}
		}

		echo json_encode($status);
	}

	public function delete($id = null) {
		$this->MarketingPackage->id = $id;

		if (!$this->MarketingPackage->exists()) {
    		$status = array('status' => 'Invalid MarketingPackage');
		} else {
			$this->request->onlyAllow('post', 'delete');
			if ($this->MarketingPackage->delete()) {
    			$status = array('status' => 'OK');
			} else {
    			$status = array('status' => 'FALED');
			}
		}

		echo json_encode($status);
	}}
