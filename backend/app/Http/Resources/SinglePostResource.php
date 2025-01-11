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

        $data = $request->all();

        if (isset($data['fields'][0]) && isset($data['fields'][1])) {
            return [
                'title' => $this->title,
                'description' => $this->description,
                'primary_photo' => $this->primary_photo,
                'secondary_photo' => $this->secondary_photo,
                'third_photo' => $this->third_photo,
                'price' => $this->price,
                'date' => $this->created_at
            ];
        } else if (isset($data['fields'][0])) {
            return [
                'title' => $this->title,
                'description' => $this->description,
                'primary_photo' => $this->primary_photo,
                'price' => $this->price,
                'date' => $this->created_at
            ];
        } else if (isset($data['fields'][1])) {
            return [
                'title' => $this->title,
                'primary_photo' => $this->primary_photo,
                'secondary_photo' => $this->secondary_photo,
                'third_photo' => $this->third_photo,
                'price' => $this->price,
                'date' => $this->created_at
            ];
        } else {
            return [
                'title' => $this->title,
                'primary_photo' => $this->primary_photo,
                'price' => $this->price,
                'date' => $this->created_at
            ];
        }
        // return parent::toArray($request);
    }
}
