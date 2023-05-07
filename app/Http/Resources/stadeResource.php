<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class stadeResource extends JsonResource
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
            'pays' => $this->pays,
            'capacite' => $this->capacite,
            'surface' => $this->surface,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'proprietaire' => $this->proprietaire,
            'telephone' => $this->telephone,
            'adresse' => $this->adresse,
            'image' => $this->image,
            'etat' => $this->etat,
            'description' => $this->description,
            'date dernier travaux' => $this->date_dernier_travaux,
        ];
    }
}