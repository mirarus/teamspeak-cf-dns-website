<?php require(dirname(__DIR__, 2) . '/Layout/_meta.php'); ?>

<!-- style -->
<!-- build:css -->
<link rel="stylesheet" href="<?php url('assets-admin/css/bootstrap.min.css', 1); ?>">
<link rel="stylesheet" href="<?php url('assets-admin/css/theme.min.css', 1); ?>">
<link rel="stylesheet" href="<?php url('assets-admin/css/style.min.css', 1); ?>">
<link rel="stylesheet" href="<?php url('assets-admin/libs/toastify/toastify.min.css', 1); ?>">
<link rel="stylesheet"
      href="<?php url('assets-admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css', 1); ?>">
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
                        <span class="text-muted">Kontrol Paneli</span>
                    </li>
                    <li>
                        <a href="<?php url(null, 1); ?>" class="no-ajax">
                            <span class="nav-icon text-secondary"><i data-feather='home'></i></span>
                            <span class="nav-text">Ana Sayfa</span>
                        </a>
                    </li>
                    <li class="nav-header hidden-folded">
                        <span class="text-muted">Ayarlar</span>
                    </li>
                    <li>
                        <a href="<?php url("settings/site", 1); ?>" class="no-ajax">
                            <span class="nav-icon text-success"><i data-feather='settings'></i></span>
                            <span class="nav-text">Site ayarları</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php url("settings/dns", 1); ?>" class="no-ajax">
                            <span class="nav-icon text-warning"><i data-feather='settings'></i></span>
                            <span class="nav-text">Dns ayarları</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php url("users", 1); ?>" class="no-ajax">
                            <span class="nav-icon text-danger"><i data-feather='users'></i></span>
                            <span class="nav-text">Kullanıcılar</span>
                        </a>
                    </li>
                    <li class="nav-header hidden-folded">
                        <span class="text-muted">-</span>
                    </li>
                    <li>
                        <a href="<?php url("tickets", 1); ?>" class="no-ajax">
                            <span class="nav-icon text-warning"><i data-feather='voicemail'></i></span>
                            <span class="nav-text">Destek Talepleri</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php url("dns", 1); ?>" class="no-ajax">
                            <span class="nav-icon text-primary"><i data-feather='globe'></i></span>
                            <span class="nav-text">Dnd Kayıtları</span>
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
                <li class="nav-item">
                    <a class="nav-link" href="<?php url("logout", 1); ?>">Çıkış Yap</a>
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
    let _page = "<?php url(page(), 1); ?>";
    let _url = "<?php url(null, 1); ?>";
    let _locale = "tr";
    let ajaxSetupLoadingText = "Lütfen Bekleyin";
</script>
<!-- jQuery -->
<script src="<?php url('assets-admin/libs/jquery/dist/jquery.min.js', 1); ?>"></script>
<script src="<?php url('assets-admin/libs/toastify/toastify.min.js', 1); ?>"></script>
<!-- Bootstrap -->
<script src="<?php url('assets-admin/libs/popper.js/dist/umd/popper.min.js', 1); ?>"></script>
<script src="<?php url('assets-admin/libs/bootstrap/dist/js/bootstrap.min.js', 1); ?>"></script>
<!-- lazyload plugin -->
<script src="<?php url('assets-admin/js/lazyload.config.js', 1); ?>"></script>
<script src="<?php url('assets-admin/js/lazyload.min.js', 1); ?>"></script>
<script src="<?php url('assets-admin/js/plugin.min.js', 1); ?>"></script>
<!-- scrollreveal -->
<script src="<?php url('assets-admin/libs/scrollreveal/dist/scrollreveal.min.js', 1); ?>"></script>
<!-- feathericon -->
<script src="<?php url('assets-admin/libs/feather-icons/dist/feather.min.js', 1); ?>"></script>
<script src="<?php url('assets-admin/js/plugins/feathericon.min.js', 1); ?>"></script>
<!-- dt -->
<script src="<?php url('assets-admin/libs/datatables/media/js/jquery.dataTables.min.js', 1); ?>"></script>
<script src="<?php url('assets-admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js', 1); ?>"></script>
<!-- theme -->
<script src="<?php url('assets-admin/js/theme.min.js', 1); ?>"></script>
<!-- site -->
<script src="<?php url('index.min.js', 1); ?>"></script>
<script src="<?php url('assets-admin/js/site.min.js', 1); ?>"></script>
<script src="<?php url('assets-admin/js/pages/setting.min.js', 1); ?>"></script>
<script src="<?php url('assets-admin/js/pages/dns.min.js', 1); ?>"></script>
<script src="<?php url('assets-admin/js/pages/user.min.js', 1); ?>"></script>
<script src="<?php url('assets-admin/js/pages/ticket.min.js', 1); ?>"></script>
<!-- endbuild -->
</body>
</html>