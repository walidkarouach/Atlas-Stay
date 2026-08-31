<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;

class User extends Authenticatable
{
    protected $primaryKey = 'id_user';

    public $timestamps = false;

    protected $fillable = [
        'nom',
        'email',
        'password',
        'telephone',
        'photo',
        'role_id',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id_role');
    }
}