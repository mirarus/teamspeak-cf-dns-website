<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight"><?= _('Dashboard'); ?></h2>
        </div>
    </div>
</div>
<div class="page-content page-container" id="page-content">
    <div class="padding sr">
        <div class="alert bg-success mb-5 py-4" role="alert">
            <div class="d-flex">
                <i data-feather="info" width="48" height="48"></i>
                <div class="px-3">
                    <h5 class="alert-heading"><?= _("Hi!"); ?></h5>
                    <p><?= _("First of all, I would like to say that we are very happy to see you among us."); ?></p>
                </div>
            </div>
        </div>
        <div class="row row-sm text-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row row-sm">
                            <div class="col-4">
                                <small class="text-muted"><?= _('User Count'); ?></small>
                                <div class="mt-2 font-weight-500 text-info"><?php echo getViewData('count')['user']; ?></div>
                            </div>
                            <div class="col-4">
                                <small class="text-muted"><?= _('Ticket Count'); ?></small>
                                <div class="mt-2 font-weight-500 text-info"><?php echo getViewData('count')['ticket']; ?></div>
                            </div>
                            <div class="col-4">
                                <small class="text-muted"><?= _('Dns Count'); ?></small>
                                <div class="mt-2 font-weight-500 text-info"><?php echo getViewData('count')['dns']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>