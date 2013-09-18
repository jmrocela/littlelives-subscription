<?php
App::uses('AppController', 'Controller');

class ProductsController extends AppController {

	public function beforeFilter() {
		$this->response->type('json');
    	$this->autoRender = false;
	}

	public function index() {
		$this->Product->recursive = 0;
    	$result = $this->Product->find('all');
        echo json_encode(Set::extract('/Product/.', $result));
	}

	public function view($id = null) {
		if (!$this->Product->exists($id)) {
			echo json_encode(array('status' => 'Product with id:' . $id . ' does not exist.'));
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$result = $this->Product->find('first', $options);
	        echo json_encode($result['Product']);
        }
	}

	public function add() {
    	$status = array('status' => 'FAILED');

		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
        		$status = array('status' => 'OK');
			}
		}
		echo json_encode($status);
	}

	public function addToCatalog() {
		$status = array('status' => 'OK');
		echo json_encode($status);
	}

	public function edit($id = null) {
		if (!$this->Product->exists($id)) {
			$status = array('status' => 'Invalid Product');
		} else {
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Product->save($this->request->data)) {
					$status = array('status' => 'OK');
				} else {
					$status = array('status' => 'FALED');
				}
			} else {
				$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
				$this->request->data = $this->Product->find('first', $options);
				echo json_encode($this->request->data['Product']);
			}
		}

		echo json_encode($status);
	}

	public function delete($id = null) {
		$this->Product->id = $id;

		if (!$this->Product->exists()) {
    		$status = array('status' => 'Invalid Product');
		} else {
			$this->request->onlyAllow('post', 'delete');
			if ($this->Product->delete()) {
    			$status = array('status' => 'OK');
			} else {
    			$status = array('status' => 'FALED');
			}
		}

		echo json_encode($status);
	}}
