<?php

namespace App\Libs\Enums;

class TicketStatus
{
	const CLOSED = ["gd-danger", "Closed"];
	const AWAITING_ANSWER = ["gd-success", "Awaiting Answer"];
	const ANSWERED = ["gd-info", "Answered"];
}