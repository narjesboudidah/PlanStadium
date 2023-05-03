<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class matchResource extends JsonResource
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
            'date' => $this->date,
            'heure' => $this->heure,
            'type match' => $this->type_match,
            'user' => new UserResource($this->whenLoaded('user')),
            'competition' => new UserResource($this->whenLoaded('competitions')),
            'stade' => new UserResource($this->whenLoaded('stades')),
            'equipe1' => new UserResource($this->whenLoaded('equipes')),
            'equipe2' => new UserResource($this->whenLoaded('equipes')),
        ];
    }
}