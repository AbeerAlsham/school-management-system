<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentClassroomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'serial_number' => $this->serial_number,
            'student' => [
                'id' => $this->studentClass->student->id,
                'photo' => $this->studentClass->student->photo,
                'first_name' => $this->studentClass->student->first_name,
                'last_name' => $this->studentClass->student->last_name,
            ]
        ];
    }
}
