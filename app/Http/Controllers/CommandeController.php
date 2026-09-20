<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function acheter(Request $request)
    {   
        if (!session('parcel_id')) {
            return redirect('/connecter')
                ->with('message', 'Vous devez être connecté pour passer une commande.');
        }

        $panier = Panier::with('produit')
                    ->where('parcel_id', session('parcel_id'))
                    ->get();

       if ($panier->isEmpty()) {
            return redirect('/panier')
                ->with(
                    'message',
                    'Votre panier est vide.'
                );
        }

        $total = 0;

        foreach ($panier as $ligne) {
            $total += $ligne->produit->prix * $ligne->quantite;
        }

        $numeroTicket = 'LT-' . date('YmdHis') . '-' . rand(100, 999);

        $commande = Commande::create([
            'parcel_id' => session('parcel_id'),
            'numero_ticket' => $numeroTicket,
            'total' => $total,
        ]);

        foreach ($panier as $ligne) {   
            $commande->produits()->attach(
                $ligne->produit_id,
                [
                    'quantite' => $ligne->quantite,
                    'prix' => $ligne->produit->prix,
                ]
            );
        }

        Panier::where('parcel_id', session('parcel_id'))->delete();

        return view('ticket', compact('commande'));
    }
}








