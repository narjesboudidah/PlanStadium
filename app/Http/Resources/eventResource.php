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
            'date debut' => $this->date_debut, //mouch bidharoura tsamih id badlou kima t7eb
            'date fin' => $this->date_fin,
            'type event' => $this->type_event,
            'user' => new UserResource($this->whenLoaded('user')),
            'equipe' => new UserResource($this->whenLoaded('equipes')),
            'stade' => new UserResource($this->whenLoaded('stades')),
        ];
    }
}