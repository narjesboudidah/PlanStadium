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
            'date debut' => $this->date_debut,
            'date fin' => $this->date_fin,
            'type competition' => $this->type_competition,
            'user' => new userResource($this->whenLoaded('user')),
        ];
    }
}