<?php

namespace App\Http\Controllers\Api\User;

use App\Action\CheckAuthAndTokenAction;
use App\Action\GetMessagesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use App\Services\TicketService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TicketController extends Controller
{
    public function index(CheckAuthAndTokenAction $action, TicketService $service): AnonymousResourceCollection
    {
        $action->handle();
        return TicketResource::collection($service->getTicketsForUser());
    }

    public function store(TicketRequest $request, TicketService $service): TicketResource
    {
        return new TicketResource($service->createTicket($request->validated()));
    }

    public function show(int $id, CheckAuthAndTokenAction $action, GetMessagesAction $messagesAction, TicketService $service): JsonResponse
    {
        $action->handle();
        return response()->json($service->showTicketWithMessages($id, $messagesAction));
    }
}
