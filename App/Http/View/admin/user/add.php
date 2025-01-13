<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight"><?= _('User Create'); ?></h2>
        </div>
        <div class="flex"></div>
        <div>
            <a href="<?php url('users', 1); ?>" class="btn btn-md text-muted">
                <span class="d-none d-sm-inline mx-1"><?= _('Users'); ?></span>
                <i data-feather="users"></i>
            </a>
        </div>
    </div>
</div>
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row row-sm sr justify-content-center">
            <div class="col-md-6">
                <div class="card padding">
                    <div class="card-body">
                        <form role="form" id="user_add_form" action="" onsubmit="return false;" novalidate="novalidate">
                            <div class="flex-column row row-sm">
                                <div class="md-form-group float-label">
                                    <input id="for-email" class="md-input" type="email" value="" name="email" required>
                                    <label for="for-email"><?= _('Email'); ?></label>
                                </div>
                                <div class="md-form-group float-label">
                                    <input id="for-password" class="md-input" type="password" value="" name="password"
                                           required>
                                    <label for="for-password"><?= _('Password'); ?></label>
                                </div>
                                <div class="md-form-group float-label">
                                    <label class="md-check">
                                        <input type="checkbox" name="role">
                                        <i class="red"></i>
										<?= _('Admin'); ?>
                                    </label>
                                </div>
                                <div class="md-form-group float-label">
                                    <label class="md-check">
                                        <input type="checkbox" name="status" checked>
                                        <i class="blue"></i>
										<?= _('Status'); ?>
                                    </label>
                                </div>
								<?php echo BMVC\Libs\Csrf::input(page()); ?>
                                <div class="md-form-group text-center">
                                    <button type="submit" class="btn w-sm bg-primary">
										<?= ajaxLoad(); ?>
										<?= _('Save'); ?>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>