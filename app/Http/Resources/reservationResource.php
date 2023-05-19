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
            'date_debut' => $this->date_debut,
            'heure_debut' => $this->heure_debut,
            'date_fin' => $this->date_fin,
            'heure_fin' => $this->heure_fin,
            'type_reservation' => $this->type_reservation,
            'statut' => $this->statut,
            'nom_event' => $this->nom_event,
            'type_match' => $this->type_match,
            'stade_id' => $this->stade_id,
            'admin_fed_id' => $this->admin_fed_id,
            'admin_equipe_id' => $this->admin_equipe_id,
            'equipe1_id' => $this->equipe1_id,
            'equipe2_id' => $this->equipe2_id,
        ];
    }
}
