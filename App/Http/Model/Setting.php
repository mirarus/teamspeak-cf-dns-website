<?php

namespace App\Http\Model;

use BMVC\Libs\Model\Tree;

class Setting extends Tree
{
	protected $tableName = 'settings';

	/**
	 * @param string|null $key
	 * @param string|null $val
	 * @param bool $all
	 * @return mixed
	 */
	public function _get(string $key = null, string $val = null, bool $all = false)
	{
		return parent::get(($key ?: 'skey'), $val, $all);
	}

	/**
	 * @param string $key
	 * @param string|null $val
	 * @return int
	 */
	public function _edit(string $key, string $val = null): int
	{
		return parent::edit('skey', $key, ['sval' => $val]);
	}
}