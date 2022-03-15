<?php

namespace App\Http\Controllers\Api\Messages;

use App\Action\SendMessageAction;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;
use App\Services\TicketService;

interface SendMessage
{
    public function sendMessage(int $id, MessageRequest $request, TicketService $service, SendMessageAction $action): MessageResource;
}
