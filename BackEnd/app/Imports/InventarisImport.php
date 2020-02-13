<?php

namespace App\Imports;

use App\Models\Inventaris;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class InventarisImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Inventaris([
            'nama' => $row[0],
            'deskripsi' => $row[1],
            'jumlah' => $row[2],
            'catatan' => $row[3],
        ]);
    }

    /**
     * validation rule
     * 
     * @return array
     */
    public function rules() : array
    {
        return [
            '0' => ['nullable','string'],
            '1' => ['nullable','string'],
            '2' => ['nullable','integer'],
            '3' => ['nullable','string']
        ];
    }
}
