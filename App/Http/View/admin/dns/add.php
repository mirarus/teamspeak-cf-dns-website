<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight"><?= _('Dns Create'); ?></h2>
        </div>
        <div class="flex"></div>
        <div>
            <a href="<?php url('dns', 1); ?>" class="btn btn-md text-muted">
                <span class="d-none d-sm-inline mx-1"><?= _('Dns Records'); ?></span>
                <i data-feather="globe"></i>
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
                        <form role="form" id="dns_add_form" action="" onsubmit="return false;"
                              novalidate="novalidate">
                            <div class="md-form-group float-label">
                                <select id="for-user" class="md-input form-control" name="user">
                                    <option disabled selected><?= _('Choose User') ?></option>
									<?php foreach (getViewData('users') as $user) {
										echo '<option value="' . $user['id'] . '">' . $user['id'] . ':' . $user['email'] . '</option>';
									} ?>
                                </select>
                                <label for="for-user"><?= _('User') ?></label>
                            </div>
                            <div class="row row-sm">
                                <div class="col-sm-6">
                                    <div class="md-form-group float-label">
                                        <input id="for-name" class="md-input" type="text" value="" name="name" required>
                                        <label for="for-name"><?= _('Name'); ?></label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="md-form-group float-label">
                                        <select id="for-domain" class="md-input form-control" name="domain" required>
                                            <option disabled selected><?= _('Choose Domain') ?></option>
											<?php foreach (explode("|", getSetting('dns_domains')) as $domain) {
												echo '<option value="' . $domain . '">' . $domain . '</option>';
											} ?>
                                        </select>
                                        <label for="for-domain"><?= _('Domain') ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-sm">
                                <div class="col-sm-6">
                                    <div class="md-form-group float-label">
                                        <input id="for-ip" class="md-input" type="text" value="" name="ip" required>
                                        <label for="for-ip"><?= _('Ip'); ?></label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="md-form-group float-label">
                                        <input id="for-port" class="md-input" type="number" value="" name="port"
                                               required>
                                        <label for="for-port"><?= _('Port'); ?></label>
                                    </div>
                                </div>
                            </div>
							<?php echo BMVC\Libs\Csrf::input(page()); ?>
                            <div class="md-form-group text-center pb-0">
                                <button type="submit" class="btn w-sm bg-primary">
	                                <?= ajaxLoad(); ?>
                                    <?= _('Add'); ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>