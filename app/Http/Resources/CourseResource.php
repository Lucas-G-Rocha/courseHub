<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "workload" => $this->workload,
            "price" => $this->price,
            "professor" => [
                "id" => $this->professor_id,
                "name" => $this->professor->name,
                "email" => $this->professor->email
            ]
        ];
    }
}
