<?php

$_helpers = [];

foreach (glob(__DIR__ . "/Helpers/*.php") as $file) {
  if ($file == __DIR__ . "/Helpers/index.php") return;
  $_helpers[] = $file;
}

$_config['files'] = array_merge($_helpers, [
  __DIR__ . "/routes.php"
]);

$_config['init'] = [
  BMVC\Libs\Model::class
];

$_config['session'] = true;

BMVC\Libs\View::config([
  'path' => 'App\Http\View',
  'cache' => false,
  'theme' => 'default',
  'themes' => [
    'default' => [
      'path' => null,
      'layout' => 'Layout/Main.php'
    ],
    'admin' => [
      'path' => 'admin',
      'layout' => 'Layout/Main.php'
    ]
  ]
]);

BMVC\Libs\Env::init();
BMVC\Libs\Model::config([
  'connect' => [
	'dsn' => $_ENV['DB_DSN'],
	'username' => $_ENV['DB_USER'],
	'password' => $_ENV['DB_PASS']
  ]
]);