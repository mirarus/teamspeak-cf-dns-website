<?php

use BMVC\Core\Controller;
use BMVC\Libs\Route;

Route::error(404, function () {
	die(Controller::call('Main::error404'));
});
Route::error(500, function () {
	die(Controller::call('Main::error500'));
});

Route::middleware(['Auth', 'Maintenance'])->group(function () {
	Route::get(null, ['Main', 'index']);

	Route::prefix('settings')->group(function () {
		Route::get('site', ['Setting', 'site_index']);
		Route::get('dns', ['Setting', 'dns_index']);
		Route::middleware('Form')->group(function () {
			Route::post('site', ['Setting', '_post_site']);
			Route::post('dns', ['Setting', '_post_dns']);
		});
	});

	Route::prefix('users')->group(function () {
		Route::get(null, ['User', 'index']);
		Route::get('add', ['User', 'add']);
		Route::get('edit/:id', ['User', 'edit']);
		Route::post('get', ['User', '_post_get']);
		Route::post('delete', ['User', '_post_delete']);
		Route::middleware('Form')->group(function () {
			Route::post('add', ['User', '_post_add']);
			Route::post('edit', ['User', '_post_edit']);
		});
	});

	Route::prefix('tickets')->group(function () {
		Route::get(null, ['Ticket', 'index']);
		Route::get(':all', ['Ticket', 'view']);
		Route::post('get', ['Ticket', '_post_get']);
		Route::post('close', ['Ticket', '_post_close']);
		Route::post('delete', ['Ticket', '_post_delete']);
		Route::middleware('Form')->group(function () {
			Route::post('add', ['Ticket', '_post_add']);
			Route::post('sendMessage', ['Ticket', '_post_sendMessage']);
		});
	});

	Route::prefix('dns')->group(function () {
		Route::get(null, ['Dns', 'index']);
		Route::get('add', ['Dns', 'add']);
		Route::get('edit/:id', ['Dns', 'edit']);
		Route::post('get', ['Dns', '_post_get']);
		Route::post('delete', ['Dns', '_post_delete']);
		Route::middleware(['Form'])->group(function () {
			Route::post('add', ['Dns', '_post_add']);
			Route::post('edit', ['Dns', '_post_edit']);
		});
	});
});

Route::middleware('Auth')->group(function () {
	Route::get('signin', ['Auth', 'signin']);
	Route::get('signup', ['Auth', 'signup']);
	Route::get('logout', ['Auth', 'logout']);
	Route::middleware(['Form'])->group(function () {
		Route::post('signin', ['Auth', '_post_signin']);
		Route::post('signup', ['Auth', '_post_signup']);
	});
});