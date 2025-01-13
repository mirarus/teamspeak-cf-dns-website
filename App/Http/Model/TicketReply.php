<?php

namespace App\Http\Model;

use BMVC\Libs\Model\Tree;

class TicketReply extends Tree
{
	protected $tableName = 'ticket_replies';

	/**
	 * @param array $where
	 * @return mixed
	 */
	public function list(array $where = [])
	{
		return parent::wGet($where, true, [], "ORDER BY id ASC, time ASC");
	}

	/**
	 * @param string|null $key
	 * @param null $val
	 * @param bool $all
	 * @return mixed
	 */
	public function _get(string $key = null, $val = null, bool $all = false)
	{
		$uid = is_user() ? auth_get('id', 'user') : null;
		$_uid = ($uid ? ['user' => $uid] : []);

		if ($val) {
			return parent::wget(array_merge([($key ?: 'id') => $val], $_uid), $all);
		} else {
			return parent::wget($_uid, $all);
		}
	}
}