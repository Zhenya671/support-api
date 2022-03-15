<?php

namespace App\Action;

class StatusDeterminationAction
{
    public function handle(): int
    {
        $uri = request()->getRequestUri();
        $status = 0;
        if (stripos($uri, 'closed')){
            $status = 3;
        } elseif (stripos($uri, 'in-process')){
            $status = 2;
        } elseif (stripos($uri, 'open')) {
            $status = 1;
        }
        return $status;
    }
}
