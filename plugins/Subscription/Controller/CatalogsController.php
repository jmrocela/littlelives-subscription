<?php
App::uses('AppController', 'Controller');

class CatalogsController extends SubscriptionAppController {

	public $uses = array('Subscription.Catalog');

	public function beforeFilter() {
		$this->response->type('json');
    	$this->autoRender = false;
	}

	public function index() {
    	$result = $this->Catalog->find('all');
        echo json_encode($result);
        //echo json_encode(Set::extract('/Catalog/.', $result));
	}

	public function view($id = null) {
		if (!$this->Catalog->exists($id)) {
			echo json_encode(array('status' => 'Catalog with id:' . $id . ' does not exist.'));
		} else {
			$options = array('conditions' => array('Catalog.' . $this->Catalog->primaryKey => $id));
			$result = $this->Catalog->find('all', $options);
	        echo json_encode($result);
        }
	}

	public function add() {
    	$status = array('status' => 'FAILED');

		if ($this->request->is('post')) {
			$this->Catalog->create();
			if ($this->Catalog->save($this->request->data)) {
        		$status = array('status' => 'OK');
			}
		}
		echo json_encode($status);
	}

	public function edit($id = null) {
		if (!$this->Catalog->exists($id)) {
			$status = array('status' => 'Invalid Catalog');
		} else {
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Catalog->save($this->request->data)) {
					$status = array('status' => 'OK');
				} else {
					$status = array('status' => 'FALED');
				}
			} else {
				$options = array('conditions' => array('Catalog.' . $this->Catalog->primaryKey => $id));
				$this->request->data = $this->Catalog->find('first', $options);
				echo json_encode($this->request->data['Catalog']);
			}
		}

		echo json_encode($status);
	}

	public function delete($id = null) {
		$this->Catalog->id = $id;

		if (!$this->Catalog->exists()) {
    		$status = array('status' => 'Invalid Catalog');
		} else {
			$this->request->onlyAllow('post', 'delete');
			if ($this->Catalog->delete()) {
    			$status = array('status' => 'OK');
			} else {
    			$status = array('status' => 'FALED');
			}
		}

		echo json_encode($status);
	}}
