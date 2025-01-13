<?php

namespace App\Http\Controller;

use App\Http\Model\Dns as DnsModel;
use App\Http\Model\User as UserModel;
use BMVC\Libs\{Hash, Request, Response, Validate, View};
use Exception;
use Mirarus\TeamSpeakCFDNS as CFDNS;

class User
{

	/**
	 * @return void
	 * @throws Exception
	 */
	public function index()
	{
		View::load("user/index", [
		  'theme' => 'admin',
		  'title' => "Kullanıcılar",
		  'data' => (new UserModel)->all()
		], true);
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function add()
	{
		View::load("user/add", [
		  'theme' => 'admin',
		  'title' => "Kullanıcı oluştur"
		], true);
	}

	/**
	 * @param int $id
	 * @return void
	 * @throws Exception
	 */
	public function edit(int $id)
	{
		$_get = (new UserModel)->get('id', $id);
		if (!$_get) return getErrors(404);

		View::load("user/edit", [
		  'theme' => 'admin',
		  'title' => sprintf("Kullanıcı #%s düzenle", $_get['id']),
		  'data' => $_get
		], true);
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function _post_add(): void
	{
		$status = false;

		$email = Request::post('email');
		$password = Request::post('password');
		$_role = Request::post('role') ? 'admin' : 'user';
		$_status = Request::post('status') ? 1 : 2;

		if (Validate::check($email) && Validate::check($password) && Validate::check($_role) && Validate::check($_status)) {
			if (Validate::email($email)) {

				if (!(new UserModel)->get('email', $email)) {

					$_add = (new UserModel)->add([
					  'email' => $email,
					  'password' => Hash::make($password),
					  'role' => $_role,
					  'status' => ($_status == 1 ? 1 : 0)
					]);

					if ($_add != null) {
						$status = true;
						$result = "İşlem Başarılı";
					} else {
						$result = "İşlem başarısız";
					}
				} else {
					$result = "Mail adresi zaten kullanılıyor";
				}
			} else {
				$result = "Mail adresi geçersiz";
			}
		} else {
			$result = "Gerekli alanları doldurun";
		}
		echo Response::json($result, $status);
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function _post_edit(): void
	{
		$status = false;

		$id = Request::post('id');
		$password = Request::post('password');
		$_role = Request::post('role') ? 'admin' : 'user';
		$_status = Request::post('status') ? 1 : 2;

		if (Validate::check($id) && Validate::integer($id) && Validate::check($_role) && Validate::check($_status)) {

			$_edit = (new UserModel)->edit('id', $id, (Validate::check($password) ? [
			  'password' => Hash::make($password),
			  'role' => $_role,
			  'status' => ($_status == 1 ? 1 : 0)
			] : [
			  'role' => $_role,
			  'status' => ($_status == 1 ? 1 : 0)
			]));

			if ($_edit) {
				$status = true;
				$result = "İşlem Başarılı";
			} else {
				$result = "İşlem başarısız";
			}
		} else {
			$result = "Gerekli alanları doldurun";
		}
		echo Response::json($result, $status);
	}

	/**
	 * @return void
	 */
	public function _post_get(): void
	{
		$status = false;
		$result = null;
		$lang = [];

		$id = Request::post('id');

		if (Validate::check($id)) {

			if ($_get = (new UserModel)->get('id', $id)) {
				unset($_get['password']);
				$status = true;
				$result = $_get['id'];

				$lang = [
				  'cancel' => "Kullanıcı silme işlemi iptal edildi",
				  'confirm' => sprintf("Kullanıcı hesabı %s silinsin mi?", ($_get['id'] . ':' . $_get['email']))
				];
			}
		}
		echo Response::_json(['status' => $status, 'message' => $result, 'lang' => $lang]);
	}

	/**
	 * @return void
	 */
	public function _post_delete(): void
	{
		$status = false;

		$id = Request::post('id');

		if (Validate::check($id)) {

			foreach ((new DnsModel)->get('user', $id, true) as $item) {
				if ($item['domain']) {

					$authorization = new CFDNS\Authorization(getSetting('dns_email'), getSetting('dns_api_key'));
					$dns = new CFDNS\Dns($authorization);
					$dns->setDomain($item['domain']);

					if ($dns->delete($item['name'])) {
						(new DnsModel)->delete('id', $item['id']);
					}
				}
			}

			if ((new UserModel)->delete('id', $id)) {
				$status = true;
				$result = "İşlem Başarılı";
			} else {
				$result = "İşlem başarısız";
			}
		} else {
			$result = "Gerekli alanları doldurun";
		}
		echo Response::json($result, $status);
	}
}