<div class="page-hero page-container " id="page-hero">
    <div class="padding d-flex">
        <div class="page-title">
            <h2 class="text-md text-highlight"><?= _('Users'); ?></h2>
        </div>
        <div class="flex"></div>
        <div>
            <a href="<?php url('users/add', 1); ?>" class="btn btn-md text-muted">
                <span class="d-none d-sm-inline mx-1"><?= _('User Create'); ?></span>
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
                    <th class="text-muted w"><?= _('Email'); ?></th>
                    <th class="text-muted w"><?= _('Dns Count'); ?></th>
                    <th class="text-muted w"><?= _('Role'); ?></th>
                    <th class="d-none d-xl-table-cell text-muted w"><?= _('Status'); ?></th>
                    <th class="d-none d-xl-table-cell text-muted w"><?= _('Date'); ?></th>
                    <th class="d-none d-xl-table-cell text-muted w"><?= _('Edit Date'); ?></th>
                    <th class="d-none"></th>
                </tr>
                </thead>
                <tbody>
				<?php foreach (getViewData('data') as $d) {
					echo '<tr class="v-middle table-tr" data-id="' . $d['id'] . '">
                                <td>' . $d['id'] . '</td>
                                <td>' . $d['email'] . '</td>
                                <td>' . (new App\Http\Model\Dns)->count('user', $d['id']) . '</td>
                                <td>' . ($d['role'] == 'user' ? _('User') : _('Admin')) . '</td>
                                <td class="d-none d-xl-table-cell">' . (($d['status'] == 1) ? _("Active") : _("Passive")) . '</td>
                                <td class="d-none d-xl-table-cell">' . date("d.m.Y - H:i", $d['time']) . '</td>
                                <td class="d-none d-xl-table-cell">' . date("d.m.Y - H:i", $d['edit_time']) . '</td>
                                <td>
                                  <div class="item-action dropdown">
                                    <a href="#" data-toggle="dropdown" class="text-muted">
                                      <i data-feather="more-vertical"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right bg-black" role="menu">
                                      <a class="dropdown-item edit" href="' . url('users/edit/' . $d['id']) . '">' . _('Edit') . '</a>
                                      <button class="dropdown-item trash user_delete" data-id="' . $d['id'] . '">' . _('Delete') . '</button>
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