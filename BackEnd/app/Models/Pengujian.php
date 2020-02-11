<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengujian extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pengujian';

    /**
     * The attributes that define primary key column name
     * 
     * @var string
     */
    protected $primaryKey = 'idpengujian';
    
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
     * Pengujian Many to One User
     */
    public function pembuka()
    {
        return $this->belongsTo('App\Models\User', 'iduser_pembuka');
    }

    public function teknisi()
    {
        return $this->belongsTo('App\Models\User', 'idteknisi');
    }

    public function engineer()
    {
        return $this->belongsTo('App\Models\User', 'idengineer');
    }

    public function penutup()
    {
        return $this->belongsTo('App\Models\User', 'iduser_penutup');
    }

    /**
     * Pengujian One to One Pembayaran
     */
    public function pembayaran()
    {
        return $this->hasOne('App\Models\Pembayaran', 'idpembayaran');
    }

    /**
     * Pengujian One to Many ItemPengujian
     */
    public function itemPengujian()
    {
        return $this->hasMany('App\Models\ItemPengujian', 'idpengujian');
    }

    /**
     * LOCAL SCOPE
     */
    public function scopeOpen($query)
    {
        return $query->where('status_pengujian', true);
    }
    public function scopeClose($query)
    {
        return $query->where('status_pengujian', false);
    }
    public function scopeRutin($query)
    {
        return $query->where('nomor_laporan', 'not like', '%NR%');
    }
    public function scopeNonRutin($query)
    {
        return $query->where('nomor_laporan', 'like', '%NR%');
    }
    public function scopeLaporanAvailable($query)
    {
        return $query->whereNotNull('nama_laporan');
    }
    public function scopeLaporanUnavailable($query)
    {
        return $query->whereNull('nama_laporan');
    }
    public function scopeLunas($query){
        return $query->where('status_pembayaran', true);
    }
    public function scopeBelumLunas($query){
        return $query->where('status_pembayaran', false);
    }
}