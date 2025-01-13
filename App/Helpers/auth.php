<?php

use App\Libs\Auth;
use App\Libs\Enums\AuthRole;

/**
 * @return array|mixed|null
 */
function auth_get()
{
	return Auth::get(...func_get_args());
}

/**
 * @return bool
 */
function auth_check(): bool
{
	return Auth::check(...func_get_args());
}

/**
 * @return bool
 */
function auth_role(): bool
{
	return Auth::role(...func_get_args());
}

/**
 * @param null $arg
 * @return bool
 */
function is_user($arg = null): bool
{
	return auth_role($arg, AuthRole::USER);
}

/**
 * @param null $arg
 * @return bool
 */
function is_admin($arg = null): bool
{
	return auth_role($arg, AuthRole::ADMIN);
}