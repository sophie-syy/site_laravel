<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{   
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('paniers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('parcel_id');
            $table->unsignedBigInteger('produit_id');

            $table->integer('quantite')->default(1);

            $table->timestamps();

            $table->foreign('parcel_id')
                ->references('id')
                ->on('parcels')
                ->onDelete('cascade');

            $table->foreign('produit_id')
                ->references('id')
                ->on('produits')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paniers');
    }
};
