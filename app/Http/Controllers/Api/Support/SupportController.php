<?php

namespace App\Http\Controllers\Api\Support;

use App\Action\GetMessagesAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SupportController extends Controller
{
    public function index(TicketService $service): AnonymousResourceCollection
    {
        return TicketResource::collection($service->getTickets());
    }

    public function show(int $id, TicketService $service, GetMessagesAction $messagesAction): JsonResponse
    {
        return response()->json($service->showTicketWithMessages($id, $messagesAction));
    }
}
