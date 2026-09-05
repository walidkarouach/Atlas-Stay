<?php

namespace App\Models;

use App\Models\Avis;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hotel extends Model
{
    protected $primaryKey = 'id_hotel';

    protected $fillable = [
        'nom',
        'description',
        'ville',
        'adresse',
        'prix',
        'type_hebergement',
        'capacite',
        'disponibilite',
        'proprietaire_id',
        'statut',
    ];

    public function proprietaire(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'proprietaire_id',
            'id_user'
        );
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'hotel_id', 'id_hotel');
    }

    public function reservations()
    {
        return $this->hasMany(
            Reservation::class,
            'hotel_id',
            'id_hotel'
        );
    }

    public function avis()
    {
        return $this->hasMany(Avis::class, 'hotel_id', 'id_hotel');
    }
}