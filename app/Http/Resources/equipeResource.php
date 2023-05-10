<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class equipeResource extends JsonResource
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
            'nom_equipe' => $this->nom_equipe, //mouch bidharoura tsamih id badlou kima t7eb
            'adresse' => $this->adresse,
            'pays' => $this->pays,
            'logo' => $this->logo,
            'site_web' => $this->site_web,
            'type_equipe' => $this->type_equipe,
            'description' => $this->description,

        ];
    }
}
