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
            'ville' => $this->ville,
            'pays' => $this->pays,
            'capacite' => $this->capacite,
            'surface' => $this->surface,
            'longitude' => $this->longitude,
            'altitude' => $this->altitude,
            'proprietaire' => $this->proprietaire,
            'telephone' => $this->telephone,
            'adresse' => $this->adresse,
            'image' => $this->image,
            'description' => $this->description,
            'date dernier traveaux' => $this->date_dernier_traveaux,
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}