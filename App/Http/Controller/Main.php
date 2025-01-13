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
		  'title' => "Ana sayfa",
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
			View::load("errors/500", ['title' => "Sistem Hatası"]);
		} else {
			if (Session::get(500) == "post") {
				$res = "Post Gerekli";
			} elseif (Session::get(500) == "ajax") {
				$res = "Ajax Gerekli";
			} elseif (Session::get(500) == "form-data") {
				$res = "Form Data Gerekli";
			} elseif (Session::get(500) == "csrf") {
				$res = "Csrf Doğrulaması Gerekli";
			} else {
				$res = "Sistem Hatası";
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
			View::load("errors/404", ['title' => "Sayfa Bulunamadı"]);
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
			View::load("errors/maintenance", ['title' => "Bakım"], true);
		} else {
			echo Response::_json((PAGE ? ['message' => "Bakım", 'page' => PAGE] : ['message' => "Bakım"]));
		}
	}
}