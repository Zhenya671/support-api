<?php

namespace App\Action;

use App\Http\Resources\MessageResource;

class SendMessageAction
{
    public function handle($id, $request, $service)
    {
        return new MessageResource($service->findTicketById($id)->messages()->create($request->validated()));
    }
}
