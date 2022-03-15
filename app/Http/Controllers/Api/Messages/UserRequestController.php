<?php

namespace App\Http\Controllers\Api\Messages;

use App\Action\SendMessageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;
use App\Services\TicketService;

class UserRequestController extends Controller implements SendMessage
{
    public function sendMessage($id, MessageRequest $request, TicketService $service, SendMessageAction $action): MessageResource
    {
        return $action->handle($id, $request, $service);
    }
}
