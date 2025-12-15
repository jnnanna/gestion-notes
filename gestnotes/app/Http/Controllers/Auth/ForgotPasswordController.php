<?php
// gestnotes/app/Http/Controllers/Auth/ForgotPasswordController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // TODO: Implémenter l'envoi d'email plus tard
        
        return back()->with('status', 'Un lien de réinitialisation a été envoyé à votre adresse email.');
    }
}
