<?php $args = getViewData('data'); ?>
<div class="aside <?= $args['id'] ? 'aside-sm' : 'w-100-xs'; ?>" id="content-aside">
    <div class="d-flex flex-column w-xl modal-dialog bg-body <?= $args['id'] ? null : 'w-100-xs'; ?>" id="chat-nav">
        <div class="navbar">
            <div class="input-group flex bg-light rounded">
                <input type="text" class="form-control no-bg no-border no-shadow search"
                       placeholder="Ara..." required/>
                <span class="input-group-append">
                    <button class="btn no-bg no-shadow" type="button">
                        <i data-feather="search" class="text-fade"></i>
                    </button>
                </span>
            </div>
        </div>
        <div class="scrollable hover">
            <div class="list list-row my-3 tickets-list">
				<?php if ($args['tickets']) {
					foreach ($args['tickets'] as $d) {
						if ($user = (new App\Http\Model\User)->get('id', $d['user'])) { ?>
                            <div class="list-item " data-id="<?php echo $d['id']; ?>">
                                <div>
                                    <a href="<?php url('tickets/' . ($d['url'] ?: $d['id'] . '-' . $d['subject']), 1); ?>"
                                       class="<?= ((page() === 'tickets') ? 'no-ajax' : null); ?>">
                                        <span class="w-32 avatar <?= $args['state']['priority'][$d['priority']][0]; ?>">#<?= $d['id']; ?></span>
                                    </a>
                                </div>
                                <div class="flex text-ellipsis">
                                    <a href="<?php url('tickets/' . ($d['url'] ?: $d['id'] . '-' . $d['subject']), 1); ?>"
                                       class="item-subject text-color text-sm no-ajax"><?= $d['subject']; ?></a>
                                    <div class="item-date text-muted text-sm h-1x"><?= $user['email']; ?></div>
                                    <div class="item-date text-muted text-sm h-1x"><?= date("d.m.Y - H:i", $d['time']); ?></div>
                                </div>
                                <div>
                                    <span class="badge item-status <?= $args['state']['status'][$d['status']][0]; ?>"><?= $args['state']['status'][$d['status']][1]; ?></span>
                                </div>
                            </div>
						<?php }
					}
				} ?>
            </div>
            <div class="no-result hide">
                <div class="p-4 text-center">Sonuç Yok</div>
            </div>
        </div>
    </div>
</div>