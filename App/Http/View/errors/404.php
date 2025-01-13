<!DOCTYPE html>
<html lang="en">
<head>
	<?php require dirname(__DIR__) . '/Layout/_meta.php'; ?>
    <!-- style -->
    <!-- build:css -->
    <link rel="stylesheet" href="<?php url('assets/css/bootstrap.min.css', 1); ?>" type="text/css"/>
    <link rel="stylesheet" href="<?php url('assets/css/theme.min.css', 1); ?>" type="text/css"/>
    <!-- endbuild -->
</head>
<body class="layout-row bg-dark">
<div class="d-flex flex align-items-center h-v info theme">
    <div class="text-center p-5 w-100">
        <h1 class="display-5 my-5">Sorry! the page you are looking for doesn't exist.</h1>
        <p>Go back to <a href="<?php url(null, 1); ?>" class="b-b b-white">home</a></p>
        <p class="my-5 text-muted h4">
            -- 404 --
        </p>
    </div>
</div>
<!-- build:js -->
<!-- jQuery -->
<script src="<?php url('assets/libs/jquery/dist/jquery.min.js', 1); ?>"></script>
<!-- endbuild -->
</body>
</html>