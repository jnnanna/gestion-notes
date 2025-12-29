<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of notifications.
     */
    public function index(): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $notifications = $user
            ->notifications()
            ->paginate(20);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Mark a notification as read.
     */
    public function marquerLue(string $id): JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $notification = $user
            ->notifications()
            ->findOrFail($id);

        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read.
     */
    public function marquerToutesLues(): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user
            ->unreadNotifications
            ->markAsRead();

        return redirect()
            ->back()
            ->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }

    /**
     * Delete a notification.
     */
    public function destroy(string $id):JsonResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $notification = $user
            ->notifications()
            ->findOrFail($id);

        $notification->delete();

        return response()->json(['success' => true]);
    }
}