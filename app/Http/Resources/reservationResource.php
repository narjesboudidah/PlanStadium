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
            'date_debut' => $this->date_debut,
            'heure_debut' => $this->heure_debut,
            'date_fin' => $this->date_fin,
            'heure_fin' => $this->heure_fin,
            'type_reservation' => $this->type_reservation,
            'statut' => $this->statut,
            'nom_match' => $this->nom_match,
            'type_match' => $this->type_match,
            'nom_equipe_adversaire' => $this->nom_equipe_adversaire,
            // 'admin_equipe_id' => new UserResource($this->whenLoaded('user')),
            // 'admin_fed_id' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
