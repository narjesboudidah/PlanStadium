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
            'nom' => $this->nom,
            'date' => $this->date,
            'heure' => $this->heure,
            'type_match' => $this->type_match,
            'competition_id' => $this->competition_id,
            'stade_id' => $this->stade_id,
            'equipe1_id' => $this->equipe1_id,
            'equipe2_id' => $this->equipe2_id,
            ];
    }
}