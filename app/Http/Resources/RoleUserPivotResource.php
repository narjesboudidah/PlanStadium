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
            'role' => new roleResource($this->whenLoaded('Role')),
            'societe maintenances' => new societeMaintenanceResource($this->whenLoaded('societe_maintenances')),
            'equipe' => new equipeResource($this->whenLoaded('equipes')),
        ];
    }
}