<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'M_User';
    public $primaryKey = 'NIK';
    protected $keyType = 'string';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'samAcc', 'nama', 'email', 'NIK', 'userPrincipal','mobilePhone','title','extensionName','id_Organisasi','id_Dept','namaManager','location','created_at','updated_at'
    ];

    public function getAuthIdentifier()
    {
        return $this->NIK;
    }
}
