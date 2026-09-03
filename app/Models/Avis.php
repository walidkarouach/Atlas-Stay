<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avis extends Model
{
    protected $table = 'avis';

    protected $primaryKey = 'id_avis';

    public $timestamps = false;

    protected $fillable = [
        'note',
        'commentaire',
        'date_avis',
        'user_id',
        'hotel_id',
    ];

    protected $casts = [
        'date_avis' => 'date',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(
            User::class,
            'user_id',
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