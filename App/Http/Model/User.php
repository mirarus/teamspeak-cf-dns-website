<?php

namespace App\Http\Model;

use BMVC\Libs\Model\Tree;

class User extends Tree
{
	protected $tableName = 'users';

	/**
	 * @param string|null $par
	 * @param int|null $uid
	 * @return false|mixed
	 */
	public function _get(string $par = null, int $uid = null)
	{
		$uid = $uid ?: (!isset($_SESSION[md5('user_id')]) ? null : $_SESSION[md5('user_id')]);
		$sql = $uid ? parent::wget(array_merge(['id' => $uid], ['status' => 1])) : parent::wget(['status' => 1]);

		return $sql ? ($par ? $sql[$par] : $sql) : false;
	}
}