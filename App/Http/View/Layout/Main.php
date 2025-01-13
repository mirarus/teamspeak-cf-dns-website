<?php require "_meta.php"; ?>

<!-- style -->
<!-- build:css -->
<link rel="stylesheet" href="<?php url('assets/css/bootstrap.min.css', 1); ?>">
<link rel="stylesheet" href="<?php url('assets/css/theme.min.css', 1); ?>">
<link rel="stylesheet" href="<?php url('assets/css/style.min.css', 1); ?>">
<link rel="stylesheet" href="<?php url('assets/libs/toastify/toastify.min.css', 1); ?>">
<link rel="stylesheet" href="<?php url('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css', 1); ?>">
<!-- endbuild -->
<body class="layout-row bg-dark">
<!-- ############ Aside START-->
<div id="aside" class="page-sidenav no-shrink bg-light nav-dropdown fade" aria-hidden="true">
    <div class="sidenav h-100 modal-dialog bg-light">
        <!-- sidenav top -->
        <div class="navbar">
            <!-- brand -->
            <a href="<?php url(null, 1); ?>" class="navbar-brand">
				<?php if (getSetting('text_logo_status')) { ?>
                    <i data-feather='globe' width="32" height="32"></i>
                    <span class="hidden-folded d-inline l-s-n-1x"><?php getSetting('text_logo', 1); ?></span>
				<?php } else { ?>
                    <img src="<?php url(getSetting('logo'), 1); ?>" height="32" alt="logo">
				<?php } ?>
            </a>
            <!-- / brand -->
        </div>
        <!-- Flex nav content -->
        <div class="flex scrollable hover">
            <div class="nav-active-text-primary" data-nav>
                <ul class="nav bg">
                    <li class="nav-header hidden-folded">
                        <span class="text-muted"><?= _('Dashboard'); ?></span>
                    </li>
                    <li>
                        <a href="<?php url(null, 1); ?>" class="no-ajax">
                            <span class="nav-icon text-secondary"><i data-feather='home'></i></span>
                            <span class="nav-text"><?= _('Home'); ?></span>
                        </a>
                    </li>
                    <li class="nav-header hidden-folded">
                        <span class="text-muted">-</span>
                    </li>
                    <li>
                        <a href="<?php url("tickets", 1); ?>" class="no-ajax">
                            <span class="nav-icon text-warning"><i data-feather='voicemail'></i></span>
                            <span class="nav-text"><?= _('Support Tickets'); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php url("dns", 1); ?>" class="no-ajax">
                            <span class="nav-icon text-primary"><i data-feather='globe'></i></span>
                            <span class="nav-text"><?= _('Dns Records'); ?></span>
                        </a>
                    </li>
            </div>
        </div>
    </div>
</div>
<!-- ############ Aside END-->
<div id="main" class="layout-column flex">
    <!-- ############ Header START-->
    <div id="header" class="page-header ">
        <div class="navbar navbar-expand-lg">
            <!-- brand -->
            <a href="<?php url(null, 1); ?>" class="navbar-brand d-lg-none">
				<?php if (getSetting('text_logo_status')) { ?>
                    <i data-feather='globe' width="32" height="32"></i>
                    <span class="hidden-folded d-inline l-s-n-1x d-lg-none"><?php getSetting('text_logo', 1); ?></span>
				<?php } else { ?>
                    <img src="<?php url(getSetting('logo'), 1); ?>" class="d-lg-none" height="32" alt="logo">
				<?php } ?>
            </a>
            <!-- / brand -->
            <ul class="nav navbar-menu order-1 order-lg-2">
                <!-- User dropdown menu -->
                <li class="nav-item dropdown">
                <span href="<?= url(page()); ?>#" data-toggle="dropdown" class="nav-link px-2 pointer">
                    <i data-feather="globe"></i>
              </span>
                    <div class="dropdown-menu dropdown-menu-center w mt-3 animate fadeIn selectLocale">
						<?php foreach (locales('locales') as $locale) {
							echo '<a class="no-ajax dropdown-item ' . (($locale == locales('locale')) ? 'bg-dark' : null) . '" href="' . url(page() . '?locale=' . $locale) . '" data-locale="' . $locale . '"><span>' . (class_exists('Locale') ? Locale::getDisplayLanguage($locale, locales('locale')) : $locale) . '</span></a>';
						} ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php url("logout", 1); ?>"><?= _("Logout"); ?></a>
                </li>
                <li class="nav-item d-lg-none">
                    <a class="nav-link px-1" data-toggle="modal" data-target="#aside">
                        <i data-feather='menu' width="16" height="16"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- ############ Footer END-->
    <!-- ############ Content START-->
    <div id="content" class="flex ">
        <!-- ############ Main START-->
        <div><?php echo getViewContent(); ?></div>
        <!-- ############ Main END-->
    </div>
    <!-- ############ Content END-->
    <!-- ############ Footer START-->
	<?php require '_footer.php'; ?>
    <!-- ############ Footer END-->
</div>
<!-- build:js -->
<script>
    let _url = "<?php url(null, 1); ?>";
    let _page = "<?php url(page(), 1); ?>";
    let _locale = "<?= strtolower((class_exists('Locale') ? Locale::getPrimaryLanguage(locales('locale')) : (explode('_', locales('locale'))[0]) ?: 'en') ?: 'en'); ?>";
    let ajaxSetupLoadingText = "<?= _('Please Wait') ?>";
</script>
<!-- jQuery -->
<script src="<?php url('assets/libs/jquery/dist/jquery.min.js', 1); ?>"></script>
<script src="<?php url('assets/libs/toastify/toastify.min.js', 1); ?>"></script>
<!-- Bootstrap -->
<script src="<?php url('assets/libs/popper.js/dist/umd/popper.min.js', 1); ?>"></script>
<script src="<?php url('assets/libs/bootstrap/dist/js/bootstrap.min.js', 1); ?>"></script>
<!-- lazyload plugin -->
<script src="<?php url('assets/js/lazyload.config.js', 1); ?>"></script>
<script src="<?php url('assets/js/lazyload.min.js', 1); ?>"></script>
<script src="<?php url('assets/js/plugin.min.js', 1); ?>"></script>
<!-- scrollreveal -->
<script src="<?php url('assets/libs/scrollreveal/dist/scrollreveal.min.js', 1); ?>"></script>
<!-- feathericon -->
<script src="<?php url('assets/libs/feather-icons/dist/feather.min.js', 1); ?>"></script>
<script src="<?php url('assets/js/plugins/feathericon.min.js', 1); ?>"></script>
<!-- dt -->
<script src="<?php url('assets/libs/datatables/media/js/jquery.dataTables.min.js', 1); ?>"></script>
<script src="<?php url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js', 1); ?>"></script>
<!-- theme -->
<script src="<?php url('assets/js/theme.min.js', 1); ?>"></script>
<!-- site -->
<script src="<?php url('index.min.js', 1); ?>"></script>
<script src="<?php url('assets/js/site.min.js', 1); ?>"></script>
<script src="<?php url('assets/js/pages/dns.js', 1); ?>"></script>
<script src="<?php url('assets/js/pages/ticket.min.js', 1); ?>"></script>
<!-- endbuild -->
</body>
</html>