<?php

namespace App\Http\Controller;

use BMVC\Libs\{Request, Response, Validate, View};
use App\Http\Model\Dns as DnsModel;
use App\Http\Model\User as UserModel;
use Exception;
use Mirarus\TeamSpeakCFDNS as CFDNS;

class Dns
{

	/**
	 * @return void
	 * @throws Exception
	 */
	public function index()
	{
		View::load("dns/index", [
		  'theme' => selectTheme(),
		  'title' => "Dns Kayıtları",
		  'data' => (new DnsModel)->list()
		], true);
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function add()
	{
		View::load("dns/add", [
		  'theme' => selectTheme(),
		  'title' => "Dns Oluştur",
		  'users' => (new UserModel)->all()
		], true);
	}

	/**
	 * @param int $id
	 * @return void
	 * @throws Exception
	 */
	public function edit(int $id)
	{
		$_get = (new DnsModel)->_get('id', $id);
		if (!$_get) return getErrors(404);

		View::load("dns/edit", [
		  'theme' => selectTheme(),
		  'title' => sprintf("Dns #%s düzenle", $_get['id']),
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

		$user = (is_admin() ? Request::post('user') : auth_get('id'));
		$name = Request::post('name');
		$domain = Request::post('domain');
		$ip = Request::post('ip');
		$port = Request::post('port');

		if (Validate::check($user) && Validate::check($name) && Validate::check($domain) && Validate::check($ip) && Validate::ip_adress($ip) && Validate::check($port) && Validate::numeric($port)) {

			if ((new UserModel)->get('id', $user)) {

				if (!in_array($ip, ["localhost", "127.0.0.1", "0.0.0.0"])) {

					$authorization = new CFDNS\Authorization(getSetting('dns_email'), getSetting('dns_api_key'));
					$dns = new CFDNS\Dns($authorization);
					$dns->setDomain($domain);

					if ($dns->create($name, $ip, $port)) {

						$_add = (new DnsModel)->add([
						  'user' => $user,
						  'dns' => ($name . "." . $domain),
						  'name' => $name,
						  'domain' => $domain,
						  'ip' => $ip,
						  'port' => $port
						]);
						if ($_add != null) {
							$status = true;
							$result = "İşlem Başarılı";
						} else {
							$result = "İşlem başarısız";
						}
					} else {
						$result = "İşlem başarısız";
					}
				} else {
					$result = "Yerel IP adresleri kullanılamaz";
				}
			} else {
				$result = "Üye bulunamadı";
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
		$name = Request::post('name');
		$ip = Request::post('ip');
		$port = Request::post('port');

		if (Validate::check($id) && Validate::check($name) && Validate::check($ip) && Validate::ip_adress($ip) && Validate::check($port) && Validate::numeric($port)) {

			if ($_get = (new DnsModel)->_get('id', $id)) {

				if ($_get['domain']) {

					if ($name != $_get['name'] || $ip != $_get['ip'] || $port != $_get['port']) {

						if (!in_array($ip, ["localhost", "127.0.0.1", "0.0.0.0"])) {

							$authorization = new CFDNS\Authorization(getSetting('dns_email'), getSetting('dns_api_key'));
							$dns = new CFDNS\Dns($authorization);
							$dns->setDomain($_get['domain']);

							if ($dns->update($_get['name'], $name, $ip, $port)) {

								$_edit = (new DnsModel)->edit('id', $id, [
								  'dns' => ($name . "." . $_get['domain']),
								  'name' => $name,
								  'ip' => $ip,
								  'port' => $port
								]);
								if ($_edit) {
									$status = true;
									$result = "İşlem Başarılı";
								} else {
									$result = "İşlem başarısız";
								}
							} else {
								$result = "İşlem başarısız";
							}
						} else {
							$result = "Yerel IP adresleri kullanılamaz";
						}
					} else {
						$result = "Hiçbir değişiklik yapılmadı";
					}
				} else {
					$result = "İşlem başarısız";
				}
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

			if ($_get = (new DnsModel)->_get('id', $id)) {
				$status = true;
				$result = $_get['id'];

				$lang = [
				  'cancel' => "Dns silme işlemi iptal edildi",
				  'confirm' => sprintf("Dns %s silinsin mi?", ($_get['id'] . ':' . $_get['dns']))
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

			if ($_get = (new DnsModel)->_get('id', $id)) {

				if ($_get['domain']) {

					$authorization = new CFDNS\Authorization(getSetting('dns_email'), getSetting('dns_api_key'));
					$dns = new CFDNS\Dns($authorization);
					$dns->setDomain($_get['domain']);

					if ($dns->delete($_get['name'])) {

						if ((new DnsModel)->delete('id', $id)) {
							$status = true;
							$result = "İşlem Başarılı";
						} else {
							$result = "İşlem başarısız";
						}
					} else {
						$result = "İşlem başarısız";
					}
				} else {
					$result = "İşlem başarısız";
				}
			} else {
				$result = "İşlem başarısız";
			}
		} else {
			$result = "Gerekli alanları doldurun";
		}
		echo Response::json($result, $status);
	}
}