<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class historiqueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'action' => $this->action,
            'admin_fed_id' => $this->admin_fed_id,
        ];
    }
}