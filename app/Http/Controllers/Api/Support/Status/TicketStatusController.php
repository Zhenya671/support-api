<?php

namespace App\Http\Controllers\Api\Support\Status;

use App\Action\StatusDeterminationAction;
use App\Services\TicketService;

class TicketStatusController
{
    public function changeStatus($id, TicketService $service, StatusDeterminationAction $action)
    {
        return $service->updateStatusTicketById($id, $action->handle());
    }
}
