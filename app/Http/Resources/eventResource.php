<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class eventResource extends JsonResource
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
            'date debut' => $this->date_debut, 
            'heure debut' => $this->heure_debut,
            'date fin' => $this->date_fin,
            'heure fin' => $this->heure_fin,
            'type event' => $this->type_event,
            'equipe' => new equipeResource($this->whenLoaded('equipes')),
            'stade' => new stadeResource($this->whenLoaded('stades')),
        ];
    }
}