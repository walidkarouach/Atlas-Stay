<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationWebController extends Controller
{
    public function index(Request $request)
    {
        $reservations = Reservation::with([
            'hotel:id_hotel,nom,ville,adresse,prix,type_hebergement'
        ])
        ->where('utilisateur_id', $request->user()->id_user)
        ->orderByDesc('created_at')
        ->paginate(10);

        return view('reservations.index', compact('reservations'));
    }
}