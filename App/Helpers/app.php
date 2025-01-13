<?php

use App\Http\Model\Setting;

/**
 * @param array $file
 * @param int $size
 * @param string $type
 * @return array|false|mixed
 * @throws ImagickException
 */
function fileUpload(array $file, int $size = 5, string $type = 'any')
{
	$class = new BMVC\Libs\Upload;
	$class->setPath('files');
	$class->setFile($file);
	$class->setType($type);
	$class->setSize($size * 1024);
	$class->setRand(5);

	return $class->upload() ?: $class->getError()['error'];
}

/**
 * @param string|null $key
 * @param bool $print
 * @return mixed|void
 */
function getSetting(string $key = null, bool $print = false)
{
	$data = (new Setting)->_get(null, $key);
	if ($print) {
		echo $data['sval'];
	} else {
		return $data['sval'];
	}
}

function ajaxLoad(): string
{
	return '<span class="ajaxLoadSpin spinner-border spinner-border-sm mr-1 d-none"></span><i class="ajaxLoadAlert mr-1 d-none" data-feather="alert-circle"></i>';
}

function selectTheme(): string
{
	return (is_admin() ? 'admin' : 'default');
}