<?php

namespace App\Libs\Enums;

class TicketStatus
{
	const CLOSED = ["gd-danger", "Kapalı"];
	const AWAITING_ANSWER = ["gd-success", "Cevap Bekleniyor"];
	const ANSWERED = ["gd-info", "Cevaplandı"];
}