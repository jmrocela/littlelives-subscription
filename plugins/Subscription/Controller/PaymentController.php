<?php

App::uses('AppController', 'SubscriptionAppController');

class PaymentController extends SubscriptionAppController {

	public $components = array('Subscription.PaypalWPP');

	public $uses = array('Subscription.Catalog', 'Subscription.MarketingPackage', 'Subscription.MarketingPackageItem', 'Subscription.Organisation', 'Subscription.Subscription', 'Subscription.Transaction');

	public $loggedInAs = 2;

	// check for access token in beforeFilter

	public function form() {
		// return a UI post to confirm
		$data = $_POST;
		$this->set($data);
		$this->render('Demo/ask');
		return false;
	}

	public function confirm() {
		$data = $_POST;

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
			$txns = array();

			$proceed = true;

			foreach ($catalogs as $catalog) {
				$find = $this->Subscription->find('all', array('recursive' => -1, 'conditions' => array('Subscription.catalogs_id' => $catalog, 'Subscription.organisations_id' => $this->loggedInAs)));
				if (!empty($find)) {
					$this->redirect($data['error_url'] . '&subscribed');
					return false;
				}
			}

			if ($proceed) {

		        $firstName = urlencode($data['Sale']['first_name']);
		        $lastName = urlencode($data['Sale']['last_name']);
		        $creditCardType = urlencode($data['Sale']['card_type']);
		        $creditCardNumber = urlencode($data['Sale']['card_number']);
		        $expDateMonth = $data['Sale']['exp']['month'];
		        $padDateMonth = urlencode(str_pad($expDateMonth, 2, '0', STR_PAD_LEFT));
		        $expDateYear = urlencode($data['Sale']['exp']['year']);
		        $cvv2Number = urlencode($data['Sale']['cvv2']);
		        $amount = urlencode($data['Sale']['amount']);

		        $nvp = '&PAYMENTACTION=Sale';
		        $nvp .= '&AMT='.$amount;
		        $nvp .= '&CREDITCARDTYPE='.$creditCardType;
		        $nvp .= '&ACCT='.$creditCardNumber;
		        $nvp .= '&CVV2='.$cvv2Number;
		        $nvp .= '&EXPDATE='.$padDateMonth.$expDateYear;
		        $nvp .= '&FIRSTNAME='.$firstName;
		        $nvp .= '&LASTNAME='.$lastName;
		        $nvp .= '&COUNTRYCODE=SG&CURRENCYCODE=USD';

		        $response = $this->PaypalWPP->wpp_hash('DoDirectPayment', $nvp);

		        if ($response['ACK'] != 'Success') {
		        	$proceed = false;
	        	}
	        }

	        if ($proceed) {
	        	$cancellation = (isset($data['cancellation_allowed'])) ? $data['cancellation_allowed']: 0;

				foreach ($catalogs as $catalog) {
					$find = $this->Subscription->find('all', array('recursive' => -1, 'conditions' => array('Subscription.catalogs_id' => $catalog, 'Subscription.organisations_id' => $this->loggedInAs)));
					if (empty($find)) {
						$datas[] = array(
							'Subscription' => array(
								'catalogs_id' => $catalog,
								'organisations_id' => $this->loggedInAs,
								'effective_date' => time(),
								'duration' => '+' . str_replace('+', '', $data['duration']),
								'cancellation_allowed' => $cancellation
							)
						);

				    	$txns[] = array(
				    		'Transaction' => array(
					    		'organisations_id' => $this->loggedInAs,
					    		'catalogs_id' => $catalog,
					    		'txn' => $response['TRANSACTIONID'],
					    		'timestamp' => time()
				    		)
		    			);
					}
				}

				$this->Subscription->saveMany($datas);	
				$this->Transaction->saveMany($txns);

	        } else {
				$this->redirect($data['error_url']);
				return false;
			}

			$this->redirect($data['return_url']);
		}
	}

}
