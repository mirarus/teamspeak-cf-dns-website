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
 * @return bool
 */
function is_user(): bool
{
	return auth_role(func_get_arg(0), AuthRole::USER);
}

/**
 * @return bool
 */
function is_admin(): bool
{
	return auth_role(func_get_arg(0), AuthRole::ADMIN);
}