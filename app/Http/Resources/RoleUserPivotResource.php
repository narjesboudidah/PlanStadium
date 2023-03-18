<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleUserPivotResource extends JsonResource
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
            'user' => new UserResource($this->whenLoaded('user')),
            'role' => new UserResource($this->whenLoaded('Role')),
            'societe maintenances' => new UserResource($this->whenLoaded('societe_maintenances')),
            'equipe' => new UserResource($this->whenLoaded('equipes')),
        ];
    }
}