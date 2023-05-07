<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class societeMaintenanceResource extends JsonResource
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
            'adresse' => $this->adresse,
            'tel' => $this->tel,
            'logo' => $this->logo,
            'email' => $this->email,
            'description' => $this->description,
            'admin_ste' => new historiqueResource($this->whenLoaded('user')),
        ];
    }
}