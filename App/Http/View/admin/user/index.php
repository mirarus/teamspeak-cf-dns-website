<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight">Kullanıcılar</h2>
        </div>
        <div class="flex"></div>
        <div>
            <a href="<?php url('users/add', 1); ?>" class="btn btn-md text-muted">
                <span class="d-none d-sm-inline mx-1">Kullanıcı Oluştur</span>
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
                    <th class="text-muted w w-12">#</th>
                    <th class="text-muted w">E-Mail</th>
                    <th class="text-muted w">Dns Sayısı</th>
                    <th class="text-muted w">Rol</th>
                    <th class="d-none d-xl-table-cell text-muted w">Durum</th>
                    <th class="d-none d-xl-table-cell text-muted w">Tarih</th>
                    <th class="d-none d-xl-table-cell text-muted w">Düzenleme Tarihi</th>
                    <th class="d-none"></th>
                </tr>
                </thead>
                <tbody>
				<?php foreach (getViewData('data') as $d) {
					echo '<tr class="v-middle table-tr" data-id="' . $d['id'] . '">
                                <td>' . $d['id'] . '</td>
                                <td>' . $d['email'] . '</td>
                                <td>' . (new App\Http\Model\Dns)->count('user', $d['id']) . '</td>
                                <td>' . ($d['role'] == 'user' ? "Kullanıcı" : "Yönetici") . '</td>
                                <td class="d-none d-xl-table-cell">' . (($d['status'] == 1) ? "Aktif" : "Pasif") . '</td>
                                <td class="d-none d-xl-table-cell">' . date("d.m.Y - H:i", $d['time']) . '</td>
                                <td class="d-none d-xl-table-cell">' . date("d.m.Y - H:i", $d['edit_time']) . '</td>
                                <td>
                                  <div class="item-action dropdown">
                                    <a href="#" data-toggle="dropdown" class="text-muted">
                                      <i data-feather="more-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right bg-black" role="menu">
                                      <a class="dropdown-item edit" href="' . url('users/edit/' . $d['id']) . '">Düzenle</a>
                                      <button class="dropdown-item trash user_delete" data-id="' . $d['id'] . '">Sil</button>
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