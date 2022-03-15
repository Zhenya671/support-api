<?php

namespace App\Services;

use App\Action\GetMessagesAction;
use App\Http\Resources\MessageResource;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;

class TicketService
{
    public function createTicket($formData)
    {
        return Ticket::with('status')->create($formData);
    }

    public function getTickets()
    {
        return Ticket::query()->orderBy('status_id')->paginate(15);
    }

    public function getTicketsForUser()
    {
        return Ticket::with('user')->where('user_id', '=', auth()->id())->paginate(15);
    }

    public function findTicketById($id)
    {
        return Ticket::findOrFail($id);
    }

    public function updateStatusTicketById($id, $status)
    {
        return $this->findTicketById($id)->update(['status_id' => $status]);
    }

    public function showTicketWithMessages($id, GetMessagesAction $action)
    {
        return [
            'data' => new TicketResource($this->findTicketById($id)),
            'messages' => MessageResource::collection($action->handle($id)),
        ];
    }
}
