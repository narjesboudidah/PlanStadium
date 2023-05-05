<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class permission_roleResource extends JsonResource
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
            'Role' => new RoleResource($this->whenLoaded('Role')),
            'Permission' => new PermissionResource($this->whenLoaded('Permission')),
        ];
    }
}