<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class competitionResource extends JsonResource
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
            'annee' => $this->annee,
            'date_debut' => $this->date_debut,
            'date_fin' => $this->date_fin,
            'type_competition' => $this->type_competition,
            'categorie' => $this->categorie,
            'organisateur' => $this->organisateur,
            'description' => $this->description,
        ];
    }
}