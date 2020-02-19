<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FotoLandingPageResource extends JsonResource
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
        $data['foto_url'] = $data['nama_foto'] ? $this->getFotoLink() : null;
        return $data;
    }
}
