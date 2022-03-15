<?php

namespace App\Http\Resources;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
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
            'header' => $this->header,
            'status' => $this->when(empty($this->status->name), function () {
                return 'sent';
            }, function () {
                return $this->status->name;
            }),
            'created_at' => $this->created_at->format('d.m.Y H:m'),
            'updated_at' => $this->updated_at->format('d.m.Y H:m'),
        ];
    }
}
