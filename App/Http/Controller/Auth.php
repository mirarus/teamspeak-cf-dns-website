<?php

namespace App\Http\Controller;

use BMVC\Libs\{Csrf, Request, Response, Validate, Session, Hash, View};
use App\Http\Model\User;
use Exception;

class Auth
{
	/**
	 * @throws Exception
	 */
	public function signin(): void
	{
		Csrf::remove();
		View::load("auth/signin", [
		  'title' => _("Sign in")
		]);
	}

	/**
	 * @throws Exception
	 */
	public function signup(): void
	{
		Csrf::remove();
		View::load("auth/signup", [
		  'title' => _("Sign up")
		]);
	}

	/**
	 * @return void
	 */
	public function _post_signin(): void
	{
		$status = false;

		$email = Request::post('email');
		$password = Request::post('password');

		if (Validate::check($email) && Validate::check($password)) {
			if (Validate::email($email)) {

				$_get = (new User)->get('email', $email);

				if ($_get != null && $_get['status'] == 1) {

					if (Hash::check($password, $_get['password'])) {

						Session::set(md5('user_id'), $_get['id']);

						if (Session::get(md5('user_id'))) {
							$status = true;
							$result = _("Operation success");
						} else {
							$result = _('Operation failed');
						}
					} else {
						$result = _("Invalid password");
					}
				} else {
					$result = _("An account with this informations was not found");
				}
			} else {
				$result = _('Email address is invalid');
			}
		} else {
			$result = _("Fill in the required fields");
		}

		echo Response::json($result, $status);
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function _post_signup(): void
	{
		$status = false;

		$email = Request::post('email');
		$password = Request::post('password');

		if (Validate::check($email) && Validate::check($password)) {
			if (Validate::email($email)) {

				if (!(new User)->get('email', $email)) {

					$_add = (new User)->add([
					  'email' => $email,
					  'password' => Hash::make($password),
					  'role' => 'user',
					  'status' => 1
					]);
					if ($_add != null) {

						$_get = (new User)->get('email', $email);
						if ($_get != null) {

							Session::set(md5('user_id'), $_get['id']);

							if (Session::get(md5('user_id'))) {
								$status = true;
								$result = _("Operation success");
							} else {
								$result = _('Operation failed');
							}
						} else {
							$result = _('Operation failed');
						}
					} else {
						$result = _('Operation failed');
					}
				} else {
					$result = _('Email address is already in use');
				}
			} else {
				$result = _('Email address is invalid');
			}
		} else {
			$result = _("Fill in the required fields");
		}

		echo Response::json($result, $status);
	}

	/**
	 * @return void
	 */
	public function logout(): void
	{
		Session::delete(md5('user_id'));
		Session::delete();
		Csrf::remove();
		redirect(url());
	}
}