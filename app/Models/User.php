<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Role;
use App\Models\Reservation;
use App\Models\Avis;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function hotels(): HasMany
    {
        return $this->hasMany(
            Hotel::class,
            'proprietaire_id',
            'id_user'
        );
    }

    public function reservations()
    {
        return $this->hasMany(
            Reservation::class,
            'utilisateur_id',
            'id_user'
        );
    }

    public function avis()
    {
        return $this->hasMany(
            Avis::class,
            'user_id',
            'id_user'
        );
    }
}
