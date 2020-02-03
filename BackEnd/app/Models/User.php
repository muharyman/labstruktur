<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that define primary key column name
     * 
     * @var string
     */
    protected $primaryKey = 'iduser';

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // protected $fillable = [
    //     'nama_login', 'nama_user', 'email', 'password',
    // ];

    /**
     * The attributes that are not mass assignable
     * 
     * @var array
     */
    protected $guarded = [
        'email_verified_at', 'remember_token', 'created_at', 'updated_at', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * DEFINE TABLE RELATION
     */

    /**
     * User Many to One jabatan 
     */
    public function jabatan()
    {
        return $this->belongsTo('App\Models\Jabatan', 'idjabatan');
    }

    /**
     * User One to Many Pengujian
     */

    public function pengujianSebagaiPembuka()
    {
        return $this->hasMany('App\Models\Pengujian', 'iduser_pembuka');
    }

    public function pengujianSebagaiTeknisi()
    {
        return $this->hasMany('App\Models\Pengujian', 'idteknisi');
    }

    public function pengujianSebagaiEngineer()
    {
        return $this->hasMany('App\Models\Pengujian', 'idengineer');
    }

    public function pengujianSebagaiPenutup()
    {
        return $this->hasMany('App\Models\Pengujian', 'iduser_penutup');
    }
}
