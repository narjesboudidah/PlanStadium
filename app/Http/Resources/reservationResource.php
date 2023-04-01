<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class reservationResource extends JsonResource
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
            //mouch bidharoura tsamih id badlou kima t7eb
            'date debut' => $this->date_debut,
            'date fin' => $this->date_fin,
            'type reservation' => $this->type_reservation,
            'statut' => $this->statut,
            'user' => new UserResource($this->whenLoaded('user')),
            'stade' => new UserResource($this->whenLoaded('stades')),
            'equipe' => new UserResource($this->whenLoaded('equipes')),
        ];
    }
}