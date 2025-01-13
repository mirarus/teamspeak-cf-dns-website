<?php

namespace App\Libs;

class sqAES
{

	/**
	 * @param string $password
	 * @param string $encryptData
	 * @return false|string
	 */
	public static function decrypt(string $password, string $encryptData)
	{
		$data = base64_decode($encryptData);
		$salt = substr($data, 8, 8);
		$ct = substr($data, 16);

		$rounds = 3;
		$data00 = $password . $salt;
		$md5_hash = [];
		$md5_hash[0] = md5($data00, true);
		$result = $md5_hash[0];

		for ($i = 1; $i < $rounds; $i++) {
			$md5_hash[$i] = md5($md5_hash[$i - 1] . $data00, true);
			$result .= $md5_hash[$i];
		}

		$key = substr($result, 0, 32);
		$iv = substr($result, 32, 16);

		return openssl_decrypt($ct, 'aes-256-cbc', $key, true, $iv);
	}

	/**
	 * @param string $password
	 * @param string $data
	 * @return string
	 */
	public static function crypt(string $password, string $data): string
	{
		$salt = openssl_random_pseudo_bytes(8);

		$salted = '';
		$dx = '';

		while (strlen($salted) < 48) {
			$dx = md5($dx . $password . $salt, true);
			$salted .= $dx;
		}

		$key = substr($salted, 0, 32);
		$iv = substr($salted, 32, 16);

		$encrypted_data = openssl_encrypt($data, 'aes-256-cbc', $key, true, $iv);

		return base64_encode('Salted__' . $salt . $encrypted_data);
	}
}