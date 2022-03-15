<?php

namespace App\Http\Controllers\Api\Support\Status;

use App\Action\StatusDeterminationAction;
use App\Services\TicketService;
use Illuminate\Http\RedirectResponse;

class TicketStatusController
{
    public function changeStatus($id, TicketService $service, StatusDeterminationAction $action): RedirectResponse
    {
        $service->updateStatusTicketById($id, $action->handle());
        return redirect()->route('show.ticket', $id);
    }
}
