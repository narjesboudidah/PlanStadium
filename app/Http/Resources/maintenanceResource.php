<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class maintenanceResource extends JsonResource
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
            'etat' => $this->etat,
            'statut' => $this->statut,
            'description' => $this->description,
            //'admin_fed' => new historiqueResource($this->whenLoaded('user')),
            //'admin_ste' => new historiqueResource($this->whenLoaded('user')),
            'stade' => $this->stade,
        ];
    }
}