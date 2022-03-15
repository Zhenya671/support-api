<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'message' => $this->message,
            'user_name' => User::where('id', '=', $this->user_id)->get('name'),
            'created' => $this->created_at->format('d.m.Y H:m')
        ];
    }
}
