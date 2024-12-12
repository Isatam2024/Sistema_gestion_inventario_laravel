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
        Schema::create('stock', function (Blueprint $table) {
            $table->id('Id_stock');
            $table->foreignId('Id_product')->constrained('products')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamp('last_update_date')->useCurrent();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cambiar 'services' por 'stock'
        Schema::dropIfExists('stock');
    }
};
