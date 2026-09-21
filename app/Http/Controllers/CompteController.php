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
        $produits = Produit::with('categories') 
            ->inRandomOrder() 
            ->take(3) 
            ->get(); 

        return view('welcome', compact('produits')); 
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

        $parcel = Parcel::where('email', $request->email)->first();

        if (!$parcel || !Hash::check($request->password, $parcel->password)) {
            return redirect('/connecter')
                ->with('message', 'Email ou mot de passe incorrect.');
        }

        session(['parcel_id' => $parcel->id]);

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
        session()->invalidate();

        return redirect('/connecter')
            ->with('message', 'Vous êtes déconnecté.');
    }
    

    public function supprimer_compte()
    {
        $parcel = Parcel::find(session('parcel_id'));
        if ($parcel) {$parcel->delete();}

        session()->invalidate();
        return redirect('/creer')
            ->with('message', 'Votre compte a été supprimé.');
    }


    public function modifier_infos(Request $request)
    {
        if (!session('parcel_id')) {
            return redirect('/connecter');
        }

        $parcel = Parcel::find(session('parcel_id'));

        if (!$parcel) {
            session()->forget('parcel_id');

            return redirect('/connecter');
        }

        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:parcels,email,' . $parcel->id,
            'ancien_password' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('/compte')
                ->withErrors($validator)
                ->withInput();
        }

        $parcel->nom = $request->nom;
        $parcel->prenom = $request->prenom;
        $parcel->email = $request->email;

        if ($request->filled('password')) {

            if (!$request->filled('ancien_password')) {
                return redirect('/compte')
                    ->withErrors([
                        'ancien_password' =>
                            'Veuillez saisir votre ancien mot de passe.'
                    ])
                    ->withInput();
            }

            if (!Hash::check( $request->ancien_password, $parcel->password)) {
                return redirect('/compte')
                    ->withErrors([
                        'ancien_password' =>'Votre ancien mot de passe est incorrect.'
                    ])
                    ->withInput();
            }

            $parcel->password = Hash::make(
                $request->password
            );
        }

        $parcel->save();

        return redirect('/compte')
            ->with('message', 'Vos informations ont été modifiées avec succès.');
    }


}



