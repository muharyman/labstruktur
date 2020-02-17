<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\JenisPengujianResource;

class KategoriPengujianResource extends JsonResource
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
        $this->resource->load('jenisPengujian');

        $data['jenis_pengujian'] = JenisPengujianResource::collection($this->whenLoaded('jenisPengujian'));
        
        return $data;
    }
}
