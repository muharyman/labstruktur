<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FotoLandingPage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'foto_landing_page';

    /**
     * The attributes that define primary key column name
     * 
     * @var string
     */
    protected $primaryKey = 'idfoto';
    
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
        static::deleted(function($object){
            if ($object->nama_foto) Storage::delete('public/FotoLandingPage/'.$object->nama_foto);
        });
    }

    /**
     * get link file
     */
    public function getFotoLink(){
        return route('getfile', ['filepath' => 'public/FotoLandingPage/'.$this->nama_foto]);
    }

}