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
            'date debut' => $this->date_debut,
            'heure debut' => $this->heure_debut,
            'date fin' => $this->date_fin,
            'heure fin' => $this->heure_fin,
            'etat' => $this->etat,
            'statut' => $this->statut,
            'description' => $this->description,
            'admin_fed_id' => $this->admin_fed_id,
            'admin_ste_id' => $this->admin_ste_id,
            'stade' => $this->stade,
        ];
    }
}