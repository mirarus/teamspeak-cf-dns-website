<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">Dns Kayıtları</h2>
        </div>
        <div class="flex"></div>
        <div>
            <a href="<?php url('dns/add', 1); ?>" class="btn btn-md text-muted">
                <span class="d-none d-sm-inline mx-1">Dns Oluştur</span>
                <i data-feather="plus"></i>
            </a>
        </div>
    </div>
</div>
<div class="page-content page-container" id="page-content">
    <div class="padding">
        <div class="table-responsive">
            <table class="table table-theme table-row v-middle w-100" id="datatable">
                <thead>
                <tr>
                    <th class="text-muted w-12">#</th>
                    <th class="text-muted">Dns</th>
                    <th class="text-muted">Ip</th>
                    <th class="text-muted">Port</th>
                    <th class="d-none d-md-table-cell text-muted">Tarih</th>
                    <th class="d-none d-md-table-cell text-muted">Düzenleme Tarihi</th>
                    <th class="d-none"></th>
                </tr>
                </thead>
                <tbody>
				<?php foreach (getViewData('data') as $p) {
					echo '<tr class="v-middle table-tr" data-id="' . $p['id'] . '">
                        <td>' . $p['id'] . '</td>
                                <td>' . $p['dns'] . '</td>
                                <td>' . $p['ip'] . '</td>
                                <td>' . $p['port'] . '</td>
                                <td class="d-none d-md-table-cell">' . date("d.m.Y - H:i", $p['time']) . '</td>
                                <td class="d-none d-md-table-cell">' . date("d.m.Y - H:i", $p['edit_time']) . '</td>
                                <td>
                                  <div class="item-action dropdown">
                                    <a href="#" data-toggle="dropdown" class="text-muted">
                                      <i data-feather="more-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right bg-black" role="menu">
                                      <a class="dropdown-item edit" href="' . url('dns/edit/' . $p['id']) . '">Düzenle</a>
                                      <button class="dropdown-item trash dns_delete" data-id="' . $p['id'] . '">Sil</button>
                                    </div>
                                  </div>
                                </td>
                            </tr>';
				} ?>
                </tbody>
            </table>
        </div>
    </div>
</div>