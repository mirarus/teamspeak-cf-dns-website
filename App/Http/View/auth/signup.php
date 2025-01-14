<!DOCTYPE html>
<html lang="en">
<head>
	<?php require dirname(__DIR__) . '/Layout/_meta.php'; ?>
    <!-- style -->
    <!-- build:css -->
    <link rel="stylesheet" href="<?php url('assets/css/bootstrap.min.css', 1); ?>" type="text/css"/>
    <link rel="stylesheet" href="<?php url('assets/css/theme.min.css', 1); ?>" type="text/css"/>
    <link rel="stylesheet" href="<?php url('assets/libs/toastify/toastify.min.css', 1); ?>" type="text/css"/>
    <!-- endbuild -->
</head>
<body class="layout-row bg-dark">
<div class="align-items-center d-flex flex justify-content-center">
    <div class="w-xl w-auto-sm mx-auto py-5">
        <div class="p-4 d-flex flex-column h-100">
            <!-- brand -->
            <a href="<?php url(null, 1); ?>" class="navbar-brand align-self-center">
		        <?php if (getSetting('text_logo_status')) { ?>
                    <i data-feather='globe' width="32" height="32"></i>
                    <span class="hidden-folded d-inline l-s-n-1x"><?php getSetting('text_logo', 1); ?></span>
		        <?php } else { ?>
                    <img src="<?php url(getSetting('logo'), 1); ?>" height="32" alt="logo">
		        <?php } ?>
            </a>
            <!-- / brand -->
        </div>
        <div class="card">
            <div id="content-body">
                <div class="padding p-md-4">
                    <form role="form" id="signup_form" action="" onsubmit="return false;" novalidate="novalidate">
                        <div class="form-group">
                            <label>E-Mail</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Şifre</label>
                            <input type="password" name="password" class="form-control">
                        </div>
						<?php echo BMVC\Libs\Csrf::input(page()); ?>
                        <button type="submit" class="btn gd-danger btn-block btn-md mb-4">
							<?= ajaxLoad() ?>
                            Kaydol
                        </button>
                        <div>Zaten bir hesabınız var mı?
                            <a href="<?= url('signin') ?>" class="text-primary">Giriş Yap</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="text-center text-muted"><?php require dirname(__DIR__) . '/Layout/_copyright.php'; ?></div>
    </div>
</div>
<!-- build:js -->
<script>
    let ajaxSetupLoadingText = "Lütfen Bekleyin";
</script>
<!-- jQuery -->
<script src="<?php url('assets/libs/jquery/dist/jquery.min.js', 1); ?>"></script>
<script src="<?php url('assets/libs/toastify/toastify.min.js', 1); ?>"></script>
<!-- feathericon -->
<script src="<?php url('assets/libs/feather-icons/dist/feather.min.js', 1); ?>"></script>
<script src="<?php url('assets/js/plugins/feathericon.min.js', 1); ?>"></script>
<script>feather.replace({width: 16, height: 16});</script>
<!-- site -->
<script src="<?php url('assets/js/site.min.js', 1); ?>"></script>
<script src="<?php url('assets/js/pages/auth.min.js', 1); ?>"></script>
<!-- endbuild -->
</body>
</html>