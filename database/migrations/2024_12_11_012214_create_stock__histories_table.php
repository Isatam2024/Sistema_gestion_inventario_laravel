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
        Schema::create('stock_history', function (Blueprint $table) {
            $table->id('stock_id');  // stock_id (Primary Key)
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');  // product_id (foreign key)
            $table->integer('quantity_changed');  // quantity_changed
            $table->enum('change_type', ['sale', 'purchase', 'adjustment'])->default('adjustment');  // change_type
            $table->timestamp('date')->useCurrent();  // date (TIMESTAMP)
            $table->timestamps();  // Creates created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock__histories');
    }
};
