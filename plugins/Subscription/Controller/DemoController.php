<?php

App::uses('AppController', 'SubscriptionAppController');

class DemoController extends SubscriptionAppController {

	public $uses = array('Product', 'Catalog', 'MarketingPackage', 'MarketingPackageItem', 'Organization', 'Subscription');

	public $loggedInAs = 1;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->autoRender = false;
		$this->layout = '';

		$organization = $this->Organization->find('first', array('conditions' => array('Organization.id' => $this->loggedInAs)));
		$this->set('organization', Set::extract('/Organization/.', $organization));

	}

	public function index() {
		$catalog = $this->Catalog->find('all');
        $catalog = Set::extract('/Catalog/.', $catalog);

		$package = $this->MarketingPackage->find('all');
        $package = Set::extract('/MarketingPackage/.', $package);

		// join
		$options = array('fields' => array('Subscription.catalog_id'), 'conditions' => array('Subscription.organization_id' => $this->loggedInAs));
		$subscriptions = $this->Subscription->find('list', $options);

		$options = array('conditions' => array('Catalog.id' => array_values($subscriptions)));
		$subscriptions = $this->Catalog->find('all', $options);
        $subscriptions = Set::extract('/Catalog/.', $subscriptions);

        $p = array();
        foreach($subscriptions as $subs) {
        	$p[] = $subs['id'];
        }

        foreach($catalog as $key => $value) {
        	$catalog[$key]['subscribed'] = (in_array($value['id'], $p)) ? true: false;
        }

		$this->set(compact('catalog', 'package', 'subscriptions'));

		$this->render('Demo/index');
	}

	public function pass() {
		$data = $_POST;

		if (!$data['return_url']) {
			$data['error_url'] = $data['error_url'] ? $data['error_url']: 'http://local.littlelives.com/subscriptions?payment_failed';
			$this->redirect($data['error_url']);
			return false;
		}

		$post = array();
		foreach ($data as $key => $value) {
			$post[] = $key . '=' . $value;
		}

		$this->redirect($data['return_url'] . '?' . join('&', $post));
	}

	public function ask() {
		// return a UI post to confirm
		$data = $_GET;
		$this->set($data);
		$this->render('Demo/ask');
		return false;
	}

	public function confirm() {
		// post to accept and return UI
		// call accept by curl and return payment status
		$data = $_POST;

		// if payment is okay; confirm subscription and add to database
		if ($this->accept($data)) { // <-- supposed to be a curl call
			$this->render('Demo/confirm');
		} else {
			$this->render('Demo/error');
		}
	}

	public function accept($data) {
		$catalogs = array();
		if ($data['store_type'] == 'package') {
			// get catalogs from post
			$options = array('conditions' => array('MarketingPackageItem.marketing_package_id' => $data['store_id']));
			$package = $this->MarketingPackageItem->find('all', $options);

			foreach ($package as $pack) {
				$catalogs[] = $pack['MarketingPackageItem']['catalog_id'];
			}
		} else {
			$catalogs[] = $data['store_id'];
		}

		if ($catalogs) {
			$datas = array();
			foreach ($catalogs as $catalog) {
				$datas[] = array(
					'catalog_id' => $catalog,
					'organization_id' => $this->loggedInAs,
					'effective_date' => time(),
					'comments' => ''
				);
			}
			$this->Subscription->saveMany($datas);

			return true;
		}

		return false;
	}

}
