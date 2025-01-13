<?php $args = getViewData('data'); ?>
<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight"><?php echo sprintf(_("User #%s Edit"), $args['id'], $args['email']); ?></h2>
        </div>
        <div class="flex"></div>
        <div>
            <a href="<?php url('users', 1); ?>" class="btn btn-md text-muted">
                <span class="d-none d-sm-inline mx-1"><?= _('Users') ?></span>
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
                        <form role="form" id="user_edit_form" action="" onsubmit="return false;"
                              novalidate="novalidate">
                            <div class="flex-column row row-sm">
                                <div class="md-form-group float-label">
                                    <input id="for-email" class="md-input" type="email"
                                           value="<?php echo $args['email']; ?>"
                                           name="email" required>
                                    <label for="for-email"><?= _('Email') ?></label>
                                </div>
                                <div class="md-form-group float-label">
                                    <input id="for-password" class="md-input" type="password" value="" name="password"
                                           required>
                                    <label for="for-password"><?= _('Password') ?></label>
                                </div>
                                <div class="md-form-group float-label">
                                    <label class="md-check">
                                        <input type="checkbox"
                                               name="role" <?php echo($args['role'] == 'admin' ? 'checked' : null); ?>>
                                        <i class="red"></i>
										<?= _('Admin') ?>
                                    </label>
                                </div>
                                <div class="md-form-group float-label">
                                    <label class="md-check">
                                        <input type="checkbox"
                                               name="status" <?php echo($args['status'] == 1 ? 'checked' : null); ?>>
                                        <i class="blue"></i>
										<?= _('Status') ?>
                                    </label>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $args['id']; ?>">
								<?php echo BMVC\Libs\Csrf::input('users/edit'); ?>
                                <div class="md-form-group text-center">
                                    <button type="submit" class="btn w-sm bg-primary">
										<?= ajaxLoad(); ?>
										<?= _('Save') ?>
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