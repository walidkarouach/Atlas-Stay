<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    
    use HasApiTokens;

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