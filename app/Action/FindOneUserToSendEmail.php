<?php

namespace App\Action;

use App\Models\User;

class FindOneUserToSendEmail
{
    public function __invoke($request)
    {
        return User::where('id', '=', $request->user_id)->first();
    }
}
