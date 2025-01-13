<?php

namespace App\Http\Model;

use BMVC\Libs\Model\Tree;

class Ticket extends Tree
{
	protected $tableName = 'tickets';

	/**
	 * @param string|null $key
	 * @param null $val
	 * @return mixed
	 */
	public function list(string $key = null, $val = null)
	{
		return $this->_get($key, $val, true, "ORDER BY status DESC, priority DESC, time DESC, id DESC");
	}

	/**
	 * @param string|null $key
	 * @param null $val
	 * @param bool $all
	 * @param string|null $query
	 * @return mixed
	 */
	public function _get(string $key = null, $val = null, bool $all = false, string $query = null)
	{
		$uid = is_user() ? auth_get('id', 'user') : null;
		$_uid = ($uid ? ['user' => $uid] : []);

		if ($val) {
			return parent::wget(array_merge([($key ?: 'id') => $val], $_uid), $all, [], $query);
		} else {
			return parent::wget($_uid, $all, [], $query);
		}
	}
}