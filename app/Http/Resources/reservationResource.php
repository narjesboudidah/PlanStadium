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
            'note' => $this->note,
            'date debut' => $this->date_debut, 
            'heure debut' => $this->heure_debut,
            'date fin' => $this->date_fin,
            'heure fin' => $this->heure_fin,
            'type reservation' => $this->type_reservation,
            'statut' => $this->statut,
            'admin_equipe_id' => new UserResource($this->whenLoaded('user')),
            'admin_fed_id' => new UserResource($this->whenLoaded('user')),
        ];
    }
}