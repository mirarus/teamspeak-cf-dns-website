<?php $args = getViewData('data'); ?>
<div class="d-flex flex fixed-content" style="top: 6.9rem;height: calc(100vh - 6.9rem);">
	<?php require 'aside.php'; ?>
    <div class="d-flex flex pr-md-3 <?= $args['id'] ? null : 'ml-3 mt-3'; ?>" id="content-body">
        <div class="d-flex flex-column flex card m-0" id="chat-list" data-plugin="chat">
			<?= $args['id'] ? '<input type="hidden" id="ticket_id" value="' . $args['id'] . '"/>' . PHP_EOL : null; ?>
            <div class="navbar flex-nowrap b-b">
                <button data-toggle="modal" data-target="#content-aside" data-modal
                        class="d-md-none btn btn-sm btn-icon no-bg">
                    <span><i data-feather="menu"></i></span>
                </button>
                <span class="align-items-center d-flex flex mx-1 text-ellipsis">
                     <span class="w-32 avatar <?= $args['state']['priority'][$args['priority']][0]; ?>">#<?= $args['id']; ?></span>
                     <span class="text-xs text-highlight mx-2 text-ellipsis"><?= $args['subject']; ?></span>
                </span>
                <span class="flex"></span>
                <div>
                    <div class="align-items-center ticket_head">
						<?php if ($args['status'] != 1) { ?>
                            <button class="btn btn-sm gd-dark text-white" id="ticket_close_btn">
                                <span class="d-none d-sm-inline mx-1">Bileti Kapat</span>
                                <i data-feather="x"></i>
                            </button>
						<?php } else { ?>
                            <div class="btn btn-sm gd-danger text-white">Bilet Kapalı</div>
						<?php } ?>
                    </div>
                </div>
            </div>
            <div class="scrollable hover">
                <div class="loading m-3"></div>
                <div class="list hide">
                    <div class="p-3">
                        <div class="chat-list">
							<?php if ($args['replies']) {
								foreach ($args['replies'] as $d) {
									if ($user = (new App\Http\Model\User)->get('id', $d['user'])) {
										$pass = ($args['id'] + $args['time'] + strlen((string)$args['subject']) + $d['time']);
										$decrypt = App\Libs\sqAES::decrypt($pass, $d['message']);
										if ($user['role'] == 'admin') { ?>
                                            <div class="chat-item">
                                                <span class="avatar w-48 gd-warning"
                                                      style="font-size: 10px;">Yönetici</span>
                                                <div class="chat-body">
                                                    <div class="chat-content rounded msg bg-body"><?= htmlspecialchars_decode($decrypt); ?></div>
                                                    <div class="chat-date date"><?= date("d.m.Y - H:i", $d['time']); ?></div>
                                                </div>
                                            </div>
										<?php } elseif ($user['role'] == 'user' && $user['id'] === $d['user']) { ?>
                                            <div class="chat-item" data-class="alt">
                                                <span class="avatar w-48 gd-info"
                                                      style="font-size: 10px;">Sen</span>
                                                <div class="chat-body">
                                                    <div class="chat-content rounded msg bg-body"><?= htmlspecialchars_decode($decrypt); ?></div>
                                                    <div class="chat-date date"><?= date("d.m.Y - H:i", $d['time']); ?></div>
                                                </div>
                                            </div>
										<?php }
									}
								}
							} ?>
                        </div>
                        <div class="hide">
                            <div class="chat-item" id="chat-item" data-class="alt">
                                <span class="avatar w-48 writer gd-info"
                                      style="font-size: 10px;">Sen</span>
                                <div class="chat-body">
                                    <div class="chat-content rounded msg block bg-body"></div>
                                    <div class="chat-date date"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-auto b-t ticket_foot">
                <form role="form" id="ticket_send_form" action="" onsubmit="return false;"
                      novalidate="novalidate">
                    <div class="p-2 px-3 d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control no-shadow no-border"
                                   placeholder="Bir şeyler yaz" name="msg" id="input_msg">
                            <input type="hidden" name="id" value="<?= $args['id']; ?>">
							<?php echo BMVC\Libs\Csrf::input("tickets/sendMessage"); ?>
                            <button class="btn btn-icon btn-rounded gd-success" type="submit" id="sendMsgBtn">
								<?= ajaxLoad(); ?>
                                <i class="sendIcon" data-feather="send"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>