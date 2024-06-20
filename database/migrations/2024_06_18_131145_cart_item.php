<?php

use App\Models\barangModel;
use App\Models\cart;
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
        Schema::create('cartItem', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(cart::class);
            $table->foreignIdFor(barangModel::class);
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartItem');
    }
};
