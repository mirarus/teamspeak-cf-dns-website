<?php

namespace App\Http\Middleware;

use BMVC\Libs\{Request, Csrf, Session};

class Form
{

	/**
	 * @var array
	 */
	private $whitelist = [
	  'post' => [],
	  'ajax' => [],
	  'form-data' => [
		"settings/site"
	  ],
	  'csrf' => []
	];

	/**
	 * @return void
	 */
	public function handle(): void
	{
		Session::delete('500');
		if (!in_array(page(), $this->whitelist['post'])) {
			if (!Request::isPost()) {
				Session::set('500', 'post');
				getErrors(500);
			}
		}
		if (!in_array(page(), $this->whitelist['ajax'])) {
			if (!Request::isAjax()) {
				Session::set('500', 'ajax');
				getErrors(500);
			}
		}
		if (!in_array(page(), $this->whitelist['form-data'])) {
			if (!Request::isFormData()) {
				Session::set('500', 'form-data');
				getErrors(500);
			}
		}
		if (!in_array(page(), $this->whitelist['csrf'])) {
			if (!Csrf::verify(page())) {
				Session::set('500', 'csrf');
				getErrors(500);
			}
		}
		Session::delete('500');
	}
}