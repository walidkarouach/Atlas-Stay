<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationWebController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::where(
            'utilisateur_id',
            $request->user()->id_user
        )
        ->orderByDesc('created_at')
        ->get();

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(Request $request, int $id)
    {
        $notification = Notification::findOrFail($id);

        if ($notification->utilisateur_id !== $request->user()->id_user) {
            abort(403);
        }

        $notification->update([
            'lu' => true,
        ]);

        return redirect()
            ->route('notifications.index')
            ->with('success', 'Notification marquée comme lue.');
    }

    public function markAllAsRead(Request $request)
    {
        Notification::where(
            'utilisateur_id',
            $request->user()->id_user
        )
        ->where('lu', false)
        ->update([
            'lu' => true,
        ]);

        return redirect()
            ->route('notifications.index')
            ->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }
}