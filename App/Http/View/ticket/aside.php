<?php $args = getViewData('data'); ?>
<div class="aside <?= $args['id'] ? 'aside-sm' : 'w-100-xs'; ?>" id="content-aside">
    <div class="d-flex flex-column w-xl modal-dialog bg-body <?= $args['id'] ? null : 'w-100-xs'; ?>" id="chat-nav">
        <div class="navbar">
            <div class="input-group flex bg-light rounded">
                <input type="text" class="form-control no-bg no-border no-shadow search"
                       placeholder="<?= _("Search..."); ?>"
                       required="">
                <span class="input-group-append">
          <button class="btn no-bg no-shadow" type="button"><i data-feather="search" class="text-fade"></i></button>
        </span>
            </div>
        </div>
        <div class="pb-2 px-3">
            <button class="btn btn-sm btn-block box-shadows gd-danger text-white" data-toggle="modal"
                    data-target="#ticket_new_modal"><?= _("Create a new support ticket"); ?>
            </button>
        </div>
        <div class="scrollable hover">
            <div class="list list-row my-3 tickets-list">
				<?php if ($args['tickets']) {
					foreach ($args['tickets'] as $d) { ?>
                        <div class="list-item " data-id="<?php echo $d['id']; ?>">
                            <div>
                                <a href="<?php url('tickets/' . ($d['url'] ?: $d['id'] . '-' . $d['subject']), 1); ?>"
                                   class="<?= ((page() === 'tickets') ? 'no-ajax' : null); ?>">
                                    <span class="w-32 avatar <?= $args['state']['priority'][$d['priority']][0]; ?>">#<?= $d['id']; ?></span>
                                </a>
                            </div>
                            <div class="flex text-ellipsis">
                                <a href="<?php url('tickets/' . ($d['url'] ?: $d['id'] . '-' . $d['subject']), 1); ?>"
                                   class="item-subject text-color text-sm  <?= ((page() === 'tickets') ? 'no-ajax' : null); ?>"><?= $d['subject']; ?></a>
                                <div class="item-date text-muted text-sm h-1x"><?= date("d.m.Y - H:i", $d['time']); ?></div>
                            </div>
                            <div>
                                <span class="badge item-status <?= $args['state']['status'][$d['status']][0]; ?>"><?= _($args['state']['status'][$d['status']][1]); ?></span>
                            </div>
                        </div>
					<?php }
				} ?>
            </div>
            <div class="no-result hide">
                <div class="p-4 text-center"><?= _("No Results"); ?></div>
            </div>
        </div>
    </div>
</div>
<!-- modal -->
<div id="ticket_new_modal" class="modal fade" data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content bg-body">
            <div class="modal-header border-bottom">
                <h5 class="modal-title text-md"><?= _("Create a new support ticket"); ?></h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body padding">
                <form role="form" id="ticket_new_form" action="" onsubmit="return false;" novalidate="novalidate">
                    <div class="flex-column row row-sm">
                        <div class="md-form-group float-label">
                            <input class="md-input" type="text" name="subject" required>
                            <label><?= _("Subject"); ?></label>
                        </div>
                        <div class="md-form-group float-label">
                            <select class="md-input form-control" name="priority" required>
                                <option disabled selected><?= _("Choose Priority"); ?></option>
								<?php foreach ($args['state']['priority'] as $key => $val) {
									echo '<option value="' . $key . '" ' . ($key == 1 ? 'selected' : null) . '>' . _($val[1]) . '</option>';
								} ?>
                            </select>
                            <label><?= _("Priority"); ?></label>
                        </div>
                        <div class="md-form-group float-label">
                            <input class="md-input" type="text" name="message" required>
                            <label><?= _("Message"); ?></label>
                        </div>
						<?php echo BMVC\Libs\Csrf::input("tickets/add"); ?>
                        <div class="md-form-group text-center pb-0">
                            <button type="submit" class="btn btn-sm gd-danger w-sm">
								<?= ajaxLoad() ?>
								<?= _("Create"); ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- / .modal -->