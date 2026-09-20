<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Produit;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Categorie::with('produits')->get();

        return view('menu', compact('categories'));
    }
}

