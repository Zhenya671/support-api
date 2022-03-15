<?php

namespace App\Http\Controllers\Api\Messages;

use App\Action\FindOneUserToSendEmail;
use App\Action\SendMessageAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;
use App\Jobs\ResponseSupportJob;
use App\Services\TicketService;

class SupportResponseController extends Controller implements SendMessage
{
    public function sendMessage($id, MessageRequest $request, TicketService $service, SendMessageAction $action): MessageResource
    {
        $user = new FindOneUserToSendEmail();
        $this->dispatch(new ResponseSupportJob($user($request)));

        return $action->handle($id, $request, $service);
    }
}
