<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\FotoInventarisResource;

class InventarisResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        
        // eager load
        $this->resource->load('fotoInventaris');
        
        $data['photos'] = FotoInventarisResource::collection($this->whenLoaded('fotoInventaris'));
        $data['file_url'] = $data['nama_file'] ? $this->getFileLink() : null;  
        return $data;
    }
}
