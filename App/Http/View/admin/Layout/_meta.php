<!DOCTYPE html>
<html lang="tr">
<head>
    <title><?php echo getViewData('title'); ?> | <?php getSetting('title', 1); ?></title>
    <base href="<?php url(null, 1); ?>"/>

    <meta charset="utf-8"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta name="robots" content="index,follow">
    <meta name="author" content="Ali Güçlü <aliguclutr@gmail.com> @mirarus | @github.com/mirarus"/>

    <meta name="description" content="<?php getSetting('description', 1); ?>"/>
    <meta name="keywords" content="<?php getSetting('keywords', 1); ?>"/>

    <link rel="icon" type="image/x-icon" href="<?php url(getSetting('favicon'), 1); ?>"/>
    <link rel="icon" type="text/png" href="<?php url(getSetting('favicon'), 1); ?>"/>
