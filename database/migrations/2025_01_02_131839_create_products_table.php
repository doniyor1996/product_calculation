<?php

use App\Models\Category;
use App\Models\User;
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
            $table->id();
            $table->foreignIdFor(User::class)
                ->constrained();
            $table->foreignIdFor(Category::class)
                ->constrained();

            $table->string('name');
            $table->string('description');
            $table->decimal('price', 16);

            $table->timestamps();
            $table->softDeletes();

            $table->unique([
                'user_id',
                'category_id',
                'name',
            ]);
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
