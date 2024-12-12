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
        Schema::create('products', function (Blueprint $table) {
            $table->id();  // Si deseas usar 'id_product' como la columna primaria
            $table->string("name");  // Nombre del producto
            $table->string("description");  // Descripción del producto
            $table->decimal("price", 10, 2);  // Precio del producto (con decimales)
            $table->enum("status", ['active', 'inactive'])->default('active');  // Estado (activo o inactivo)
            $table->timestamps();  // Tiempos de creación y actualización
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
