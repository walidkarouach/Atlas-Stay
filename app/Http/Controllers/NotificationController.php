<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $notifications = Notification::where(
            'utilisateur_id',
            $request->user()->id_user
        )
        ->orderByDesc('created_at')
        ->get();

        return response()->json([
            'message' => 'Liste de vos notifications',
            'data' => $notifications,
        ]);
    }

    public function markAsRead(Request $request, int $id): JsonResponse
    {
        $notification = Notification::findOrFail($id);

        if ($notification->utilisateur_id !== $request->user()->id_user) {
            return response()->json([
                'message' => 'Vous ne pouvez modifier que vos propres notifications',
            ], 403);
        }

        $notification->update([
            'lu' => true,
        ]);

        return response()->json([
            'message' => 'Notification marquée comme lue',
            'data' => $notification,
        ]);
    }

    public function unread(Request $request): JsonResponse
    {
        $notifications = Notification::where(
            'utilisateur_id',
            $request->user()->id_user
        )
        ->where('lu', false)
        ->orderByDesc('created_at')
        ->get();

        return response()->json([
            'message' => 'Liste des notifications non lues',
            'data' => $notifications,
        ]);
    }

    public function markAllAsRead(Request $request): JsonResponse
    {
        Notification::where(
            'utilisateur_id',
            $request->user()->id_user
        )
        ->where('lu', false)
        ->update([
            'lu' => true,
        ]);

        return response()->json([
            'message' => 'Toutes les notifications ont été marquées comme lues',
        ]);
    }
}