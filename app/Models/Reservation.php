<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';

    protected $primaryKey = 'id_reservation';

    protected $fillable = [
        'date_arrivee',
        'date_depart',
        'nb_personnes',
        'montant_total',
        'statut',
        'utilisateur_id',
        'hotel_id',
    ];

    protected $casts = [
        'date_arrivee' => 'date',
        'date_depart' => 'date',
        'montant_total' => 'decimal:2',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(
            User::class,
            'utilisateur_id',
            'id_user'
        );
    }

    public function hotel()
    {
        return $this->belongsTo(
            Hotel::class,
            'hotel_id',
            'id_hotel'
        );
    }
}