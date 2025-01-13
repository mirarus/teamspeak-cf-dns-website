<?php

namespace App\Http\Controller;

use App\Http\Model\Setting as settingModel;
use BMVC\Libs\{Request, Response, Validate, View};
use Exception;

class Setting
{

	/**
	 * @return void
	 * @throws Exception
	 */
	public function site_index()
	{
		View::load("setting/site", [
		  'theme' => 'admin',
		  'title' => "Site Ayarları"
		], true);
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function dns_index()
	{
		View::load("setting/dns", [
		  'theme' => 'admin',
		  'title' => "Dns Ayarları"
		], true);
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function _post_site()
	{
		$status = false;
		$e_favicon = false;
		$e_logo = false;

		$favicon = Request::files('favicon');
		$logo = Request::files('logo');
		$text_logo = Request::post('text_logo');
		$text_logo_status = Request::post('text_logo_status') ? 1 : 2;
		$site_status = Request::post('site_status') ? 1 : 2;
		$title = Request::post('title');
		$description = Request::post('description');
		$keywords = Request::post('keywords');

		if (Validate::check($text_logo_status) && Validate::check($site_status) && Validate::check($title) && Validate::check($description) && Validate::check($keywords)) {

			if (Validate::check($favicon)) {
				$_favicon = fileUpload($favicon, 10, 'image');
				if (Validate::check($_favicon) && Validate::array($_favicon) && Validate::check($_favicon['name'])) {
					unlink(getSetting('favicon'));
					$e_favicon = (new settingModel)->_edit('favicon', $_favicon['file']);
				}
			}
			if (Validate::check($logo)) {
				$_logo = fileUpload($logo, 10, 'image');
				if (Validate::check($_logo) && Validate::array($_logo) && Validate::check($_logo['name'])) {
					unlink(getSetting('logo'));
					$e_logo = (new settingModel)->_edit('logo', $_logo['file']);
				}
			}

			$e_text_logo = (new settingModel)->_edit('text_logo', $text_logo);
			$e_text_logo_status = (new settingModel)->_edit('text_logo_status', ($text_logo_status == 1 ? 1 : 0));
			$e_site_status = (new settingModel)->_edit('site_status', ($site_status == 1 ? 1 : 0));
			$e_title = (new settingModel)->_edit('title', $title);
			$e_description = (new settingModel)->_edit('description', $description);
			$e_keywords = (new settingModel)->_edit('keywords', $keywords);

			if ($e_favicon || $e_logo || $e_text_logo || $e_text_logo_status || $e_site_status || $e_title || $e_description || $e_keywords) {
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
	 * @throws Exception
	 */
	public function _post_dns()
	{
		$status = false;

		$dns_email = Request::post('dns_email');
		$dns_api_key = Request::post('dns_api_key');
		$dns_domains = Request::post('dns_domains');

		if (Validate::check($dns_email) && Validate::check($dns_api_key) && Validate::check($dns_domains)) {

			$e_dns_email = (new settingModel)->_edit('dns_email', $dns_email);
			$e_dns_api_key = (new settingModel)->_edit('dns_api_key', $dns_api_key);
			$e_dns_domains = (new settingModel)->_edit('dns_domains', $dns_domains);

			if ($e_dns_email || $e_dns_api_key || $e_dns_domains) {
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