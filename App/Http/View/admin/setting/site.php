<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">Site Ayarları</h2>
        </div>
    </div>
</div>
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="row row-sm sr justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body padding">
                        <form role="form" id="setting_site_form" action="" onsubmit="return false;"
                              novalidate="novalidate">
                            <div class="row row-sm">
                                <div class="col-sm-4">
                                    <div class="d-flex float-label md-form-group">
                                        <img class="w-32 avatar circle avatar ajax"
                                             src="<?php url(getSetting('favicon'), 1); ?>"
                                             alt="">
                                        <div class="ml-3 custom-file md-input setting_site_favicon">
                                            <input type="file" class="custom-file-input" id="favicon" name="favicon"
                                                   accept="image/*">
                                            <label class="custom-file-label mb-0"
                                                   for="favicon">Simge</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="d-flex float-label md-form-group">
                                        <img class="w-32 avatar circle avatar ajax"
                                             src="<?php url(getSetting('logo'), 1); ?>"
                                             alt="">
                                        <div class="ml-3 custom-file md-input setting_site_logo">
                                            <input type="file" class="custom-file-input" id="logo" name="logo"
                                                   accept="image/*">
                                            <label class="custom-file-label mb-0" for="logo">Logo</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group md-form-group">
                                        <input class="md-input form-control" type="text"
                                               value="<?php getSetting('text_logo', 1); ?>"
                                               name="text_logo" placeholder="Yazılı Logo" required>
                                        <div class="input-group-append">
                                            <div class="border-left-0 border-right-0 border-top-0 btn btn-icon input-group-text rounded-0">
                                                <input type="checkbox" name="text_logo_status"
                                                       aria-label="Status" <?php echo(getSetting('text_logo_status') == 1 ? 'checked' : null); ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-sm">
                                <div class="col-sm-4">
                                    <div class="md-form-group float-label">
                                        <select id="for-site_status" class="md-input form-control" name="site_status">
                                            <option disabled selected>Durum Seçin</option>
                                            <option value="1" <?php echo(getSetting('site_status') == 1 ? 'selected' : null); ?>>
                                                Açık
                                            </option>
                                            <option value="0" <?php echo(getSetting('site_status') == 0 ? 'selected' : null); ?>>
                                                Kapalı
                                            </option>
                                        </select>
                                        <label for="for-site_status">Site Durumu</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="md-form-group float-label">
                                        <input id="for-title" class="md-input" type="text"
                                               value="<?php getSetting('title', 1); ?>"
                                               name="title"
                                               required>
                                        <label for="for-title">Başlık</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="md-form-group float-label">
                                        <input id="for-description" class="md-input" type="text"
                                               value="<?php getSetting('description', 1); ?>"
                                               name="description"
                                               required>
                                        <label for="for-description">Açıklama</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-sm">
                                <div class="col-sm-12">
                                    <div class="md-form-group float-label">
                                        <input id="for-keywords" class="md-input" type="text"
                                               value="<?php getSetting('keywords', 1); ?>"
                                               name="keywords"
                                               required>
                                        <label for="for-keywords">Anahtar Kelimeler</label>
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