<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ItemPengujianResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $result = parent::toArray($request);
        // if ($result->nama_foto) $result['foto'] = Storage::get('FotoInventaris/'.$result->nama_foto);
        // if ($result->nama_file) $result['file'] = Storage::get('FileInventaris/'.$result->nama_file);
        return $result;
    }
}
