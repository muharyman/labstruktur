<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPengujian extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kategori_pengujian';

    /**
     * The attributes that define primary key column name
     * 
     * @var string
     */
    protected $primaryKey = 'idkategori_pengujian';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * DEFINE TABLE RELATION
     */

    /**
     * KategoriPengujian One to Many JenisPengujian
     */

    public function JenisPengujian()
    {
        return $this->hasMany('App\Models\JenisPengujian', 'idkategori_pengujian');
    }
}