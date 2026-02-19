<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->title,
            'descripcion' => $this->description,
            'isbn' => $this->isbn,
            'copias_totales' => $this->total_copies,
            'copias_disponibles' => $this->available_copies,
            'estado' => (bool)$this->status,
        ];
    }
}
