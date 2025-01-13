<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">Dns Ayarları</h2>
        </div>
    </div>
</div>
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row row-sm sr justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body padding">
                        <form role="form" id="setting_dns_form" action="" onsubmit="return false;"
                              novalidate="novalidate">
                            <div class="row row-sm">
                                <div class="col-sm-6">
                                    <div class="md-form-group float-label">
                                        <input id="for-dns_email" class="md-input" type="text"
                                               value="<?php getSetting('dns_email', 1); ?>"
                                               name="dns_email" required>
                                        <label for="for-dns_email">Cloudflare E-Mail</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="md-form-group float-label">
                                        <input id="for-dns_api_key" class="md-input" type="text"
                                               value="<?php getSetting('dns_api_key', 1); ?>"
                                               name="dns_api_key" required>
                                        <label for="for-dns_api_key">Cloudflare Api Anahtarı</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-sm">
                                <div class="col-sm-12">
                                    <div class="md-form-group float-label">
                                        <input id="for-dns_domains" class="md-input" type="text"
                                               value="<?php getSetting('dns_domains', 1); ?>"
                                               name="dns_domains" required>
                                        <label for="for-dns_domains">Alan Adları (Her alan adından sonra | özel karakterini kullanın. Örneğin: aaa.com|bbb.com)</label>
                                    </div>
                                </div>
                            </div>
							<?php echo BMVC\Libs\Csrf::input(page()); ?>
                            <div class="justify-content-center row row-sm">
                                <button type="submit" class="btn w-sm bg-primary">
	                                <?= ajaxLoad(); ?>
                                    Kaydet
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>