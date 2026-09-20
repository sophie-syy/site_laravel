<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Produit;
use Illuminate\Http\Request;

class PanierController extends Controller
{

    public function index()
    {
        if (session('parcel_id')) {
            $panier = Panier::with('produit')
                ->where('parcel_id', session('parcel_id'))
                ->get();
        } else {
            $panier = session('panier', []);
        }

        return view('panier', compact('panier'));
    }

    public function ajouter(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
        $quantite = max(1, (int) $request->quantite);

        if (session('parcel_id')) {
            $panier = Panier::where('parcel_id', session('parcel_id'))
                ->where('produit_id', $id)
                ->first();

            if ($panier) {
                $panier->quantite += $quantite;
                $panier->save();
            } else {
                Panier::create([
                    'parcel_id' => session('parcel_id'),
                    'produit_id' => $produit->id,
                    'quantite' => $quantite,
                ]);
            }
        }
        else {
            $panier = session('panier', []);

            if (isset($panier[$id])) {
                $panier[$id]['quantite'] += $quantite;
            } else {
                $panier[$id] = [
                    'id' => $produit->id,
                    'nom' => $produit->nom,
                    'description' => $produit->description,
                    'prix' => $produit->prix,
                    'image' => $produit->image,
                    'quantite' => $quantite,
                ];
            }

            session(['panier' => $panier]);
        }

        return redirect('/menu')
            ->with('produit_ajoute', $produit->nom);
    }

    public function supprimer($id)
    {
        if (session('parcel_id')) {
            Panier::where('id', $id)
                ->where('parcel_id', session('parcel_id'))
                ->delete();
        } else {
            $panier = session('panier', []);
            if (isset($panier[$id])) {unset($panier[$id]);}
            session(['panier' => $panier]);
        }

        return redirect('/panier');
    }

    public function vider()
    {
        if (session('parcel_id')) {
            Panier::where(
                'parcel_id',
                session('parcel_id')
            )->delete();
        }
        else {
            session()->forget('panier');
        }

        return redirect('/panier');
    }
}

