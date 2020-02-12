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
     * boot method
     */
    public static function boot()
    {
        parent::boot();

        // before object deleted
        static::deleting(function($object){
            $fotoInventaris = $object->fotoInventaris()->get();
            foreach($fotoInventaris as $foto){
               if ($foto->nama_foto) Storage::delete('FotoInventaris/'.$foto->nama_foto);
            }
            $object->fotoInventaris()->delete();
        });

        // after object deleted
        static::deleted(function($object){
            if ($object->nama_file) Storage::delete('FileInventaris/'.$object->nama_file);
        });
    }

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
        return $this->belongsTo('App\Models\JenisPengujian', 'idjenispengujian');
    }

    /**
     * ItemPengujian One to Many FotoInventaris
     */
    public function fotoInventaris()
    {
        return $this->hasMany('App\Models\FotoInventaris', 'iditem_pengujian');
    }
}