<?php

namespace App\Action;

class CheckAuthAndTokenAction
{
    public function handle()
    {
        if (!auth()->user()->tokenCan('ticket-view')) {
            abort(403, 'unauthorized');
        }
    }
}
