<?php
App::uses('AppController', 'Controller');

class PagesController extends AppController {

	public function display() {
		$path = func_get_args();

		$this->render(implode('/', $path));
	}
}
