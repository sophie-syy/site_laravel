<?php

namespace App\Http\Controllers;

use App\Mail\ReinitialisationMotDePasse;
use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MotDePasseController extends Controller
{
    public function afficherFormulaire()
    {
        return view('mdpOublie');
    }

    public function envoyerLien(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $parcel = Parcel::where('email', $request->email)->first();

        if (!$parcel) {
            return back()
                ->with('message', 'Aucun compte ne correspond à cet e-mail.')
                ->withInput();
        }

        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $parcel->email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        $lien = url('/mdpReinitialiser/' . $token)
            . '?email=' . urlencode($parcel->email);

        Mail::to($parcel->email)
            ->send(new ReinitialisationMotDePasse($lien));

        return back()->with(
            'message',
            'Un lien de réinitialisation a été envoyé par e-mail.'
        );
    }

    public function afficherReinitialisation(
        Request $request,
        $token
    ) {
        return view(
            'mdpReinitialiser',
            [
                'token' => $token,
                'email' => $request->email,
            ]
        );
    }

    public function reinitialiser(
        Request $request
    ) {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $reset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$reset) {
            return back()->with(
                'message',
                'Lien de réinitialisation invalide.'
            );
        }

        if (!Hash::check($request->token, $reset->token)) {
            return back()->with(
                'message',
                'Lien de réinitialisation invalide.'
            );
        }

        if (
            $reset->created_at &&
            now()->diffInMinutes($reset->created_at) > 60
        ) {
            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->delete();

            return back()->with(
                'message',
                'Ce lien a expiré. Veuillez recommencer.'
            );
        }

        $parcel = Parcel::where(
            'email',
            $request->email
        )->first();

        if (!$parcel) {
            return back()->with(
                'message',
                'Compte introuvable.'
            );
        }

        $parcel->password = Hash::make(
            $request->password
        );

        $parcel->save();

        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return redirect('/connecter')
            ->with(
                'message',
                'Votre mot de passe a été modifié avec succès.'
            );
    }
}

