<?php
App::uses('AppController', 'Controller');

class MarketingPackageItemsController extends SubscriptionAppController {

	public function beforeFilter() {
		$this->response->type('json');
    	$this->autoRender = false;
	}

	public function index() {
		$this->MarketingPackageItem->recursive = 0;
    	$result = $this->MarketingPackageItem->find('all');
        echo json_encode(Set::extract('/MarketingPackageItem/.', $result));
	}

	public function view($id = null) {
		if (!$this->MarketingPackageItem->exists($id)) {
			echo json_encode(array('status' => 'MarketingPackageItem with id:' . $id . ' does not exist.'));
		} else {
			$options = array('conditions' => array('MarketingPackageItem.' . $this->MarketingPackageItem->primaryKey => $id));
			$result = $this->MarketingPackageItem->find('all', $options);
	        echo json_encode($result);
        }
	}

	public function add() {
    	$status = array('status' => 'FAILED');

		if ($this->request->is('post')) {
			$this->MarketingPackageItem->create();
			if ($this->MarketingPackageItem->save($this->request->data)) {
        		$status = array('status' => 'OK');
			}
		}
		echo json_encode($status);
	}

	public function edit($id = null) {
		if (!$this->MarketingPackageItem->exists($id)) {
			$status = array('status' => 'Invalid MarketingPackageItem');
		} else {
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->MarketingPackageItem->save($this->request->data)) {
					$status = array('status' => 'OK');
				} else {
					$status = array('status' => 'FALED');
				}
			} else {
				$options = array('conditions' => array('MarketingPackageItem.' . $this->MarketingPackageItem->primaryKey => $id));
				$this->request->data = $this->MarketingPackageItem->find('first', $options);
				echo json_encode($this->request->data['MarketingPackageItem']);
			}
		}

		echo json_encode($status);
	}

	public function delete($id = null) {
		$this->MarketingPackageItem->id = $id;

		if (!$this->MarketingPackageItem->exists()) {
    		$status = array('status' => 'Invalid MarketingPackageItem');
		} else {
			$this->request->onlyAllow('post', 'delete');
			if ($this->MarketingPackageItem->delete()) {
    			$status = array('status' => 'OK');
			} else {
    			$status = array('status' => 'FALED');
			}
		}

		echo json_encode($status);
	}}
