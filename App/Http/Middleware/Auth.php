<?php

namespace App\Http\Middleware;

use App\Libs\Enums\AuthRoute;
use BMVC\Libs\Csrf;

class Auth
{

	private $whitelist = [
	  AuthRoute::SIGNIN,
	  AuthRoute::SIGNUP,
	];

	private $user_whitelist = [
	  null,
	  AuthRoute::LOGOUT,
	  'tickets',
	  'dns'
	];

	private $admin_whitelist = [
	  null,
	  AuthRoute::LOGOUT,
	  'settings',
	  'users',
	  'tickets',
	  'dns'
	];

	/**
	 * @return void
	 */
	public function handle(): void
	{
		Csrf::remove();

		if (in_array(page(), $this->whitelist)) {
			if (auth_check()) redirect(url());
		} else {
			if (!auth_check()) redirect(url(AuthRoute::SIGNIN));

			if (is_user() && !in_array(array_shift(@explode('/', page())), $this->user_whitelist)) getErrors(404);
			if (is_admin() && !in_array(array_shift(@explode('/', page())), $this->admin_whitelist)) getErrors(404);
		}
	}
}