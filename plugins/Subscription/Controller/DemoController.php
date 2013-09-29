<?php

/*
CREATE VIEW organisation_subscriptions
AS
  SELECT O.id, O.name, S.effective_date, S.comments, S.catalogs_id
  FROM organisations as O, subscriptions as S
  WHERE O.id=S.organisations_id

DELIMITER $$
DROP FUNCTION IF EXISTS `GetAncestry` $$
CREATE FUNCTION `GetAncestry` (GivenID INT) RETURNS VARCHAR(1024)
DETERMINISTIC
BEGIN
    DECLARE rv VARCHAR(1024);
    DECLARE cm CHAR(1);
    DECLARE ch INT;

    SET rv = '';
    SET cm = '';
    SET ch = GivenID;
    WHILE ch > 0 DO
        SELECT IFNULL(`organisations_id`,-1) INTO ch FROM
        (SELECT `organisations_id` FROM organisations WHERE id = ch) A;
        IF ch > 0 THEN
            SET rv = CONCAT(rv,cm,ch);
            SET cm = ',';
        END IF;
    END WHILE;
    RETURN rv;

END $$
DELIMITER ;


// the subscription from the parent cannot be unsubscribed from the child.
*/

App::uses('AppController', 'SubscriptionAppController');

class DemoController extends SubscriptionAppController {

	public $uses = array('Subscription.Catalog', 'Subscription.MarketingPackage', 'Subscription.MarketingPackageItem', 'Subscription.Organisation', 'Subscription.Subscription');

	public $loggedInAs = 2;

	public function beforeFilter() {
		parent::beforeFilter();
		$this->autoRender = false;
		$this->layout = '';

		$organisation = $this->Organisation->find('first', array('conditions' => array('Organisation.id' => $this->loggedInAs)));
		$this->set('organisation', Set::extract('/Organisation/.', $organisation));

	}

	public function index() {
		$catalog = $this->Catalog->find('all', array('recursive' => 1));
        $catalog = Set::extract('/Catalog/.', $catalog);

		$package = $this->MarketingPackage->find('all');
        $package = Set::extract('/MarketingPackage/.', $package);

		// join
		$options = array('fields' => array('Subscription.catalogs_id'), 'conditions' => array('Subscription.organisations_id' => $this->loggedInAs));
		$subscriptions = $this->Subscription->find('list', $options);

		$parents = $this->Organisation->query('SELECT id, GetAncestry(id) as parents from organisations where id = ' . $this->loggedInAs);
		$parents = ($parents[0][0]['parents']) ? explode(',', $parents[0][0]['parents']): array();
		$parents[] = $this->loggedInAs;

		$organisations = $this->Organisation->query('SELECT * FROM littlelives.organisation_subscriptions WHERE id in (' . implode(',', $parents) . ')');
        $subscriptions = Set::extract('/organisation_subscriptions/catalogs_id/.', $organisations);

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
			$options = array('recursive' => -1, 'conditions' => array('MarketingPackageItem.marketing_packages_id' => $data['store_id']));
			$package = $this->MarketingPackageItem->find('all', $options);

			foreach ($package as $pack) {
				$catalogs[] = $pack['MarketingPackageItem']['catalogs_id'];
			}
		} else {
			$catalogs[] = $data['store_id'];
		}

		if ($catalogs) {
			$datas = array();
			foreach ($catalogs as $catalog) {
				$datas[] = array(
					'catalogs_id' => $catalog,
					'organisations_id' => $this->loggedInAs,
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
