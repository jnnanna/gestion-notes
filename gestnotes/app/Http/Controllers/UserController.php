<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs (admin).
     */
    public function index(Request $request)
    {
        $users = User::with('role', 'department')->orderBy('last_name')->paginate(20);

        if (view()->exists('admin.users.index')) {
            return view('admin.users.index', compact('users'));
        }

        // Fallback simple si la vue n'existe pas encore
        return response()->json([
            'message' => 'Liste des utilisateurs (interface admin non implémentée)',
            'count' => $users->total(),
            'data' => $users->items(),
        ]);
    }
}