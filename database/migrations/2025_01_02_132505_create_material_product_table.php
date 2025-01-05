<?php

use App\Models\Material;
use App\Models\Product;
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
        Schema::create('material_product', function (Blueprint $table) {
            $table->foreignIdFor(Material::class)
                ->constrained();
            $table->foreignIdFor(Product::class)
                ->constrained();

            $table->float('quantity', 2);

            $table->unique(['material_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material_product');
    }
};
