<?php

/**
* PUT     /organizations/{id}/subscribe?id={catalog_id|mp_id|product_id}&category={catalog|marketing_package|product}&subscribe_token={token}
* GET     /organizations/{id}/subscriptions
* 
* PUT     /organization/subscribe?id={catalog_id|mp_id|product_id}&category={catalog|marketing_package|product}&subscribe_token={token}
* GET     /organization/subscriptions
* 
* PUT     /organization/
*/

Router::connect('/subscriptions', array('plugin' => 'Subscription', 'controller' => 'demo', 'action' => 'index', 'home'));

// payments
Router::connect('/payment/form', array('plugin' => 'Subscription', 'controller' => 'payment', 'action' => 'form', '[method]' => 'POST'));
Router::connect('/payment/confirm', array('plugin' => 'Subscription', 'controller' => 'payment', 'action' => 'confirm', '[method]' => 'POST'));
Router::connect('/payment/do', array('plugin' => 'Subscription', 'controller' => 'payment', 'action' => 'do', '[method]' => 'POST'));

/**
 * Paypal IPN Flow mock for local testing
 */
// log in with initial payment detail
Router::connect('/mock/pass', array('plugin' => 'Subscription', 'controller' => 'demo', 'action' => 'pass', '[method]' => 'POST'));

Router::connect('/organisations/:id/subscriptions', array('plugin' => 'Subscription', 'controller' => 'organisations', 'action' => 'subscriptions', '[method]' => 'GET'), array('pass' => array('id')));

Router::connect('/products', array('plugin' => 'Subscription', 'controller' => 'products', 'action' => 'index', '[method]' => 'GET'));
Router::connect('/products/add', array('plugin' => 'Subscription', 'controller' => 'products', 'action' => 'add', '[method]' => 'POST'));
Router::connect('/products/:id', array('plugin' => 'Subscription', 'controller' => 'products', 'action' => 'view', '[method]' => 'GET'), array('pass' => array('id')));
Router::connect('/products/:id/edit', array('plugin' => 'Subscription', 'controller' => 'products', 'action' => 'edit', '[method]' => 'PUT'), array('pass' => array('id')));
Router::connect('/products/:id/delete', array('plugin' => 'Subscription', 'controller' => 'products', 'action' => 'delete', '[method]' => 'DELETE'), array('pass' => array('id')));

Router::connect('/catalogs', array('plugin' => 'Subscription', 'controller' => 'catalogs', 'action' => 'index', '[method]' => 'GET'));
Router::connect('/catalogs/add', array('plugin' => 'Subscription', 'controller' => 'catalogs', 'action' => 'add', '[method]' => 'POST'));
Router::connect('/catalogs/:id', array('plugin' => 'Subscription', 'controller' => 'catalogs', 'action' => 'view', '[method]' => 'GET'), array('pass' => array('id')));
Router::connect('/catalogs/:id/edit', array('plugin' => 'Subscription', 'controller' => 'catalogs', 'action' => 'edit', '[method]' => 'PUT'), array('pass' => array('id')));
Router::connect('/catalogs/:id/delete', array('plugin' => 'Subscription', 'controller' => 'catalogs', 'action' => 'delete', '[method]' => 'DELETE'), array('pass' => array('id')));

Router::connect('/packages', array('plugin' => 'Subscription', 'controller' => 'marketingpackages', 'action' => 'index', '[method]' => 'GET'));
Router::connect('/packages/add', array('plugin' => 'Subscription', 'controller' => 'marketingpackages', 'action' => 'add', '[method]' => 'POST'));
Router::connect('/packages/:id', array('plugin' => 'Subscription', 'controller' => 'marketingpackages', 'action' => 'view', '[method]' => 'GET'), array('pass' => array('id')));
Router::connect('/packages/:id/edit', array('plugin' => 'Subscription', 'controller' => 'marketingpackages', 'action' => 'edit', '[method]' => 'PUT'), array('pass' => array('id')));
Router::connect('/packages/:id/delete', array('plugin' => 'Subscription', 'controller' => 'marketingpackages', 'action' => 'delete', '[method]' => 'DELETE'), array('pass' => array('id')));

Router::connect('/packages/:id/add/:package_id', array('plugin' => 'Subscription', 'controller' => 'marketingpackageitems', 'action' => 'addToPackage', '[method]' => 'POST'), array('pass' => array('id')));
Router::connect('/package', array('plugin' => 'Subscription', 'controller' => 'marketingpackageitems', 'action' => 'index', '[method]' => 'GET'));
Router::connect('/package/add', array('plugin' => 'Subscription', 'controller' => 'marketingpackageitems', 'action' => 'add', '[method]' => 'POST'));
Router::connect('/package/:id', array('plugin' => 'Subscription', 'controller' => 'marketingpackageitems', 'action' => 'view', '[method]' => 'GET'), array('pass' => array('id')));
Router::connect('/package/:id/edit', array('plugin' => 'Subscription', 'controller' => 'marketingpackageitems', 'action' => 'edit', '[method]' => 'PUT'), array('pass' => array('id')));
Router::connect('/package/:id/delete', array('plugin' => 'Subscription', 'controller' => 'marketingpackageitems', 'action' => 'delete', '[method]' => 'DELETE'), array('pass' => array('id')));


/*Router::resourceMap(array(
    array('action' => 'index', '[method]' => 'GET', 'id' => false),
    array('action' => 'view', '[method]' => 'GET', 'id' => true),
    array('action' => 'add', '[method]' => 'POST', 'id' => false),
    array('action' => 'edit', '[method]' => 'PUT', 'id' => true),
    array('action' => 'delete', '[method]' => 'DELETE', 'id' => true),
    array('action' => 'update', '[method]' => 'POST', 'id' => true)
));*/

Router::parseExtensions('json');