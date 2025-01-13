<?php

namespace App\Http\Middleware;

use BMVC\Core\Controller;
use Exception;

class Maintenance
{

	/**
	 * @var string[]
	 */
	private $whitelist = [];

	/**
	 * @return void
	 * @throws Exception
	 */
	public function handle(): void
	{
		if (!is_admin()) {
			if (getSetting('site_status') != 1) {
				if (!in_array(page(), $this->whitelist)) {
					die(Controller::call('Main::errorMaintenance'));
				}
			}
		}
	}
}