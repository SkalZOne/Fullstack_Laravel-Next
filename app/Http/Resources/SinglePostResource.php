<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SinglePostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'title' => $this->title,
            'primary_photo' => $this->primary_photo,
            'price' => $this->price,
            'date' => $this->created_at
        ];


        // return parent::toArray($request);
    }
}
