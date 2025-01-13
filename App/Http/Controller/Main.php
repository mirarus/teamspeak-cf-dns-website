<?php

namespace App\Http\Controller;

use Exception;
use BMVC\Libs\{View, Request, Response, Session};
use App\Http\Model\{Dns, User, Ticket};

class Main
{

	/**
	 * @return void
	 * @throws Exception
	 */
	public function index()
	{
		View::load("index", [
		  'theme' => selectTheme(),
		  'title' => _("Home"),
		  'count' => [
			'user' => (is_admin() ? (new User)->count() : ""),
			'ticket' => (is_admin() ? (new Ticket)->count() : (new Ticket)->count('user', auth_get('id'))),
			'dns' => (is_admin() ? (new Dns)->count() : (new Dns)->count('user', auth_get('id')))
		  ]
		], true);
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function error500()
	{
		Response::setStatusCode(500);
		if (!Request::getReferer() || !Session::get(500)) {
			View::load("errors/500", ['title' => _("Error 500")]);
		} else {
			if (Session::get(500) == "post") {
				$res = _("Post Required");
			} elseif (Session::get(500) == "ajax") {
				$res = _("Ajax Required");
			} elseif (Session::get(500) == "form-data") {
				$res = _("Form Data Required");
			} elseif (Session::get(500) == "csrf") {
				$res = _("Csrf Validation Required");
			} else {
				$res = _("System Error");
			}
			Session::delete('500');

			echo Response::json($res, false);
		}
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function error404()
	{
		Response::setStatusCode(404);
		if (Request::isGet()) {
			View::load("errors/404", ['title' => _("Error 404")]);
		} else {
			$res = (Response::getStatusCode() . ' ' . Response::getStatusMessage());
			echo Response::_json((PAGE ? ['message' => $res, 'page' => PAGE] : ['message' => $res]), 404);
		}
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function errorMaintenance()
	{
		if (Request::isGet()) {
			View::load("errors/maintenance", ['title' => _("Maintenance")], true);
		} else {
			echo Response::_json((PAGE ? ['message' => _("Maintenance"), 'page' => PAGE] : ['message' => _("Maintenance")]));
		}
	}
}