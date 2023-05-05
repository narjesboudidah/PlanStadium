<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class actionResource extends JsonResource
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
            'titre' => $this->titre,
            'historique' => new historiqueResource($this->whenLoaded('historique')),
        ];
    }
}