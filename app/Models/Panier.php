<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    protected $fillable = [
        'parcel_id',
        'produit_id',
        'quantite',
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function parcel()
    {
        return $this->belongsTo(Parcel::class);
    }
}