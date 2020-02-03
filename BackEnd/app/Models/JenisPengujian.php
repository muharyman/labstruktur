<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPengujian extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'jenis_pengujian';

    /**
     * The attributes that define primary key column name
     * 
     * @var string
     */
    protected $primaryKey = 'idjenis_pengujian';
    
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
     * JenisPengujian Many to One KategoriPengujian
     */
    public function kategoriPengujian()
    {
        return $this->belongsTo('App\Models\KategoriPengujian', 'idkategori_pengujian');
    }

    /**
     * JenisPengujian One to Many ItemPengujian
     */
    public function itemPengujian()
    {
        return $this->hasMany('App\Models\ItemPengujian', 'idjenispengujian');
    }
}