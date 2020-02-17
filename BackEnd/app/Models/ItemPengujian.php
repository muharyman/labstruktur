<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ItemPengujian extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'item_pengujian';

    /**
     * The attributes that define primary key column name
     * 
     * @var string
     */
    protected $primaryKey = 'iditem_pengujian';
    
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
     * ItemPengujian Many to One Pengujian
     */
    public function pengujian()
    {
        return $this->belongsTo('App\Models\Pengujian', 'idpengujian');
    }

    /**
     * ItemPengujian Many to One JenisPengujian
     */
    public function jenisPengujian()
    {
        return $this->belongsTo('App\Models\JenisPengujian', 'idjenis_pengujian');
    }

    public function scopePengujian($query, $idPengujian)
    {
        return $query->where('idpengujian', $idPengujian);
    }

}