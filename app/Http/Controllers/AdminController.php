<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Parcel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function verifierAdmin()
    {
        if (!session('parcel_id')) {
            return redirect('/connecter');
        }

        $parcel = Parcel::find(session('parcel_id'));

        if (!$parcel || $parcel->role !== 'admin') {
            return redirect('/compte');
        }

        return null;
    }

    public function admin()
    {
        if ($redirect = $this->verifierAdmin()) {
            return $redirect;
        }

        $produits = Produit::with('categories')->get();
        $categories = Categorie::all();
        $parcels = Parcel::where('role', 'client')->get();

        return view( 'admin', compact('produits', 'categories', 'parcels'));
    }

    
    public function storeProduit(Request $request)
    {
        if ($redirect = $this->verifierAdmin()) {
            return $redirect;
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|string|max:255',
        ]);

        $produit = Produit::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'image' => $request->image,
        ]);

        $produit->categories()->sync($request->categories);

        return redirect('/admin')
            ->with('message', 'Produit ajouté avec succès.')
            ->with('onglet', 'produits');
    }

    public function storeCategorie(Request $request)
    {
        if ($redirect = $this->verifierAdmin()) {
            return $redirect;
        }

        $request->validate([ 'nom' => 'required|string|max:255',]);
        Categorie::create([ 'nom' => $request->nom,]);

        return redirect('/admin')
            ->with('message', 'Catégorie ajoutée avec succès.')
            ->with('onglet', 'categories');
    }

    public function updateProduit(Request $request, $id)
    {
        if ($redirect = $this->verifierAdmin()) {
            return $redirect;
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|string|max:255',
        ]);

        $produit = Produit::findOrFail($id);

        $produit->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'image' => $request->image,
        ]);

        $produit->categories()->sync($request->categories);

        return redirect('/admin')
            ->with('message', 'Produit '. $id . ' modifié avec succès.')
            ->with('onglet', 'produits');
    }


    public function updateCategorie(Request $request, $id)
    {
        if ($redirect = $this->verifierAdmin()) {
            return $redirect;
        }

        $request->validate([ 'nom' => 'required|string|max:255',]);
        $categorie = Categorie::findOrFail($id);
        $categorie->update([ 'nom' => $request->nom,]);

        return redirect('/admin')
            ->with('message', 'Catégorie modifiée avec succès.')
            ->with('onglet', 'categories');
    }


    public function destroyProduit($id)
    {
        if ($redirect = $this->verifierAdmin()) {
            return $redirect;
        }

        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect('/admin')
            ->with('message', 'Produit ' . $id . ' supprimé avec succès.')
            ->with('onglet', 'produits');
    }


    public function destroyClient($id)
    {
        if ($redirect = $this->verifierAdmin()) {
            return $redirect;
        }

        $client = Parcel::where('role', 'client')->findOrFail($id);
        $client->delete();

        return redirect('/admin')
            ->with('message', 'Client ' . $id . ' supprimé avec succès.')
            ->with('onglet', 'clients');
    }


    public function destroyCategorie($id)
    {
        if ($redirect = $this->verifierAdmin()) {
            return $redirect;
        }

        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return redirect('/admin')
            ->with('message', 'Catégorie ' . $id . ' supprimée avec succès.')
            ->with('onglet', 'categories');
    }

}




