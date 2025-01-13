<?php

namespace App\Http\Controller;

use App\Http\Model\Ticket as ticketModel;
use App\Http\Model\TicketReply as ticketReplyModel;
use App\Http\Model\User as userModel;
use App\Libs\Enums\TicketPriority;
use App\Libs\Enums\TicketStatus;
use App\Libs\sqAES;
use BMVC\Libs\{View, Request, Response, Validate};
use Exception;

class Ticket
{
	private $state = [
	  'priority' => [
		1 => TicketPriority::LOW,
		2 => TicketPriority::MIDDLE,
		3 => TicketPriority::HIGH
	  ],
	  'status' => [
		1 => TicketStatus::CLOSED,
		2 => TicketStatus::AWAITING_ANSWER,
		3 => TicketStatus::ANSWERED
	  ]
	];

	private function state(): array
	{
		$state = $this->state;

		if (is_admin()) {
			$state['status'] = [
			  1 => TicketStatus::CLOSED,
			  3 => TicketStatus::AWAITING_ANSWER,
			  2 => TicketStatus::ANSWERED
			];
		}
		return $state;
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function index()
	{
		View::load("ticket/all", [
		  'title' => _("Tickets"),
		  'theme' => selectTheme(),
		  'data' => [
			'tickets' => (new ticketModel)->list(),
			'state' => $this->state()
		  ]
		], true);
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function view($url)
	{
		$_get = null;
		$user = null;

		if (Validate::integer($url)) {
			$_get = (new ticketModel)->_get('id', $url);
			if ($_get) {
				redirect(url('tickets/' . (!empty($_get['url']) ? $_get['url'] : $_get['id'] . '-' . $_get['subject'])));
			}
		} elseif (count($_url = explode('-', $url)) === 2) {
			$_get = (new ticketModel)->_get('url', $url) ?:
			  (Validate::integer($_url[0]) ? (new ticketModel)->_get('id', $_url[0]) : null);
		}

		if (!$_get || !($user = (new userModel)->get('id', $_get['user']))) {
			redirect(url('tickets'));
		}

		View::load("ticket/view", [
		  'theme' => selectTheme(),
		  'title' => sprintf(_("Ticket - %s"), $_get['subject']),
		  'data' => array_merge($_get, [
			'tickets' => (new ticketModel)->list(),
			'replies' => (new ticketReplyModel)->list(['ticket' => $_get['id']]),
			'state' => $this->state(),
			'_user' => $user
		  ])
		], true);
	}

	/**
	 * @return void
	 */
	public function _post_get(): void
	{
		$status = false;
		$result = null;
		$lang = [];

		$id = Request::post('id');

		if (Validate::integer($id)) {
			$_get = (new ticketModel)->_get('id', $id);
			if ($_get) {

				$status = true;
				$result = [
				  'id' => (int)$_get['id'],
				  'subject' => $_get['subject'],
				  'status' => (int)$_get['status']
				];

				$lang = [
				  'required' => _('Fill in the required fields'),
				  'messageSend' => _('Message sent'),
				  'awaitingAnswer' => _('Awaiting Answer'),
				  'close' => sprintf(_("#%s Close ticket?"), ($_get['id'] . ':' . $_get['subject'])),
				  'closed' => _('Ticket closed'),
				  'closeCancel' => _('Ticket closing process canceled'),
				  'delete' => sprintf(_("#%s Delete ticket ?"), ($_get['id'] . ':' . $_get['subject'])),
				  'deleted' => _('Ticket deleted'),
				  'deleteCancel' => _('Ticket deleting process canceled'),
				];
			}
		}
		echo Response::_json(['status' => $status, 'message' => $result, 'lang' => $lang]);
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function _post_add(): void
	{
		if (!is_user()) getErrors(404);

		$status = false;

		$subject = Request::post('subject');
		$priority = Request::post('priority');
		$message = Request::post('message');

		if (Validate::check($subject) && (Validate::check($priority) && array_key_exists($priority, $this->state['priority'])) && Validate::check($message)) {
			$g_ticket = (new ticketModel)->_get('subject', $subject);
			if (!$g_ticket) {

				$time = time();
				$_add_t = (new ticketModel)->add([
				  'user' => auth_get('id'),
				  'subject' => $subject,
				  'priority' => $priority,
				  'status' => 2
				], $time);
				if ($_add_t != null) {

					$url = ($_add_t . '-' . $subject);
					$_edit = (new ticketModel)->edit('id', $_add_t, ['url' => $url]);
					if ($_edit != null) {

						$pass = ($_add_t + $time + strlen((string)$subject) + $time);
						$_add_t_msg = (new ticketReplyModel)->add([
						  'ticket' => $_add_t,
						  'user' => auth_get('id'),
						  'message' => sqAES::crypt($pass, $message),
						  'status' => 1
						]);
						if ($_add_t_msg != null) {
							$status = true;
							$result = $url;
						} else {
							$result = _('Operation failed');
						}
					} else {
						$result = _('Operation failed');
					}
				} else {
					$result = _('Operation failed');
				}
			} else {
				$result = _("Ticket already exists");
			}
		} else {
			$result = _("Fill in the required fields");
		}

		echo Response::_json(['status' => $status, 'message' => $result, 'lang' => [
		  "created" => _('Ticket created')
		]]);
	}

	/**
	 * @return void
	 * @throws Exception
	 */
	public function _post_sendMessage()
	{
		$status = false;

		$id = Request::post('id');
		$msg = Request::post('msg');

		if (Validate::integer($id) && Validate::check($msg)) {

			$_get = (new ticketModel)->_get('id', $id);
			if ($_get != null) {

				$time = time();
				$pass = ($_get['id'] + $_get['time'] + strlen((string)$_get['subject']) + $time);

				$_add = (new ticketReplyModel)->add([
				  'ticket' => $_get['id'],
				  'user' => auth_get('id'),
				  'message' => sqAES::crypt($pass, $msg)
				], $time);

				$_edit = (new ticketModel)->edit('id', $_get['id'], ['status' => is_user() ? 2 : 3]);
				if ($_add != null && $_edit != null) {

					$status = true;
					$result = [$msg, date("d.m.Y - H:i", $time)];
				} else {
					$result = _('Message could not be sent');
				}
			} else {
				$result = _("Ticket not found");
			}
		} else {
			$result = _("Fill in the required fields");
		}
		echo Response::json($result, $status);
	}

	/**
	 * @return void
	 */
	public function _post_close(): void
	{
		$status = false;

		$id = Request::post('id');

		if (Validate::integer($id)) {

			$_get = (new ticketModel)->_get('id', $id);
			if ($_get) {

				$_edit = (new ticketModel)->edit('id', $_get['id'], ['status' => 1]);
				if ($_edit != null) {
					$status = true;
					$result = _('Operation success');
				} else {
					$result = _('Operation failed');
				}
			} else {
				$result = _("Ticket not found");
			}
		} else {
			$result = _("Fill in the required fields");
		}
		echo Response::json($result, $status);
	}

	/**
	 * @return void
	 */
	public function _post_delete(): void
	{
		if (!is_admin()) getErrors(404);

		$status = false;

		$id = Request::post('id');

		if (Validate::integer($id)) {

			$_get = (new ticketModel)->_get('id', $id);
			if ($_get) {

				$_delete = (new ticketModel)->delete('id', $_get['id']);
				if ($_delete != null) {

					$_delete_replies = (new ticketReplyModel)->delete('ticket', $_get['id']);
					if ($_delete_replies != null) {
						$status = true;
						$result = _('Operation success');
					} else {
						$result = _('Operation failed');
					}
				} else {
					$result = _('Operation failed');
				}
			} else {
				$result = _("Ticket not found");
			}
		} else {
			$result = _("Fill in the required fields");
		}
		echo Response::json($result, $status);
	}
}