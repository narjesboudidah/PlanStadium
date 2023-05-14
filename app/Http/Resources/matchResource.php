<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class matchResource extends JsonResource
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
            'nom' => $this->nom,
            'date' => $this->date,
            'heure' => $this->heure,
            'type_match' => $this->type_match,
            'competition' => new UserResource($this->whenLoaded('competitions')),
            'stade' => new stadeResource($this->whenLoaded('stades')),
            'equipe1' => new equipeResource($this->whenLoaded('equipes')),
            'equipe2' => new equipeResource($this->whenLoaded('equipes')),
        ];
    }
}