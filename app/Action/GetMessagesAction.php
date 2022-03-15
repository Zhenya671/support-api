<?php

namespace App\Action;

use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetMessagesAction
{
    public function handle($id): AnonymousResourceCollection
    {
        return MessageResource::collection(Message::query()->where('ticket_id', '=', $id)->get()
            ->map(function ($message) {
                return $message;
            }));
    }
}
