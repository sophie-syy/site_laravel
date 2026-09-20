<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Produit;

class CompteController extends Controller
{
    public function home_index()
    {
        return view('welcome');
    }
    
    public function creer_index()
    {
        return view('creer');
    }

    public function connecter_index()
    {
        return view('connecter');
    }

    public function creer_parcel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:parcels,email',
            'password' => 'required|string|min:8|max:255',
            'password2' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return redirect('/creer')
                ->withErrors($validator)
                ->withInput();
        }

        Parcel::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'client',
        ]);

        return redirect('/creer')
            ->with('message', 'Compte créé avec succès !');
    }
    

    public function connecter_parcel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/connecter')
                ->withErrors($validator)
                ->withInput();
        }

        // Chercher le compte avec l'email
        $parcel = Parcel::where('email', $request->email)->first();

        // Compte inexistant ou mauvais mot de passe
        if (!$parcel || !Hash::check($request->password, $parcel->password)) {
            return redirect('/connecter')
                ->with('message', 'Email ou mot de passe incorrect.');
        }

        // Enregistrer le compte connecté
        session([
            'parcel_id' => $parcel->id
        ]);

        if ($parcel->role === 'admin') {
            return redirect('/admin');
        }

        return redirect('/compte')
            ->with(
                'message',
                'Bienvenue ' . $parcel->prenom . ' !'
            );
    }


    public function accueil()
    {
        if (!session('parcel_id')) {
            return redirect('/connecter');
        }

        $parcel = Parcel::find(session('parcel_id'));

        if (!$parcel) {
            session()->forget('parcel_id');

            return redirect('/connecter');
        }

        return view('compte', compact('parcel'));
    }

    public function deconnexion()
    {
        session()->forget('parcel_id');

        return redirect('/connecter')
            ->with('message', 'Vous êtes déconnecté.');
    }
    

    public function supprimer_compte()
    {
        $parcel = Parcel::find(session('parcel_id'));
        if ($parcel) {$parcel->delete();}

        session()->forget('parcel_id');
        return redirect('/creer')
            ->with('message', 'Votre compte a été supprimé.');
    }

}



