<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = [
        'parcel_id',
        'numero_ticket',
        'total',
    ];

    public function produits()
    {
        return $this->belongsToMany(Produit::class,'commande_produit')->withPivot(['quantite','prix',]);
    }

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }
}