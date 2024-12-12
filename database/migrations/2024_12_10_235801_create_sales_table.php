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
        Schema::create('sales', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('product_id')  // Foreign key to the products table
                  ->constrained('products')  // Assuming the related table is "products"
                  ->onDelete('cascade'); // Deletes sales if the associated product is deleted
            $table->integer('quantity'); // Quantity of products sold
            $table->decimal('total', 10, 2); // Total sale amount with 2 decimal places
            $table->timestamp('date')->useCurrent(); // Date of sale, defaults to current timestamp
            $table->enum('payment_method', ['cash', 'card', 'transfer', 'efectivo']); // Payment method
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
