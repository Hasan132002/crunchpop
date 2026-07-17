<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->string('size')->nullable();            // e.g. "2 oz bag", "4-pack"
            $table->decimal('price', 8, 2)->default(0);
            $table->unsignedInteger('pack_quantity')->default(1);
            $table->string('image')->nullable();
            $table->string('badge')->nullable();           // e.g. "Best Value", "New"
            $table->text('ingredients')->nullable();
            $table->text('allergen_info')->nullable();
            $table->boolean('is_bundle')->default(false);
            $table->boolean('is_coming_soon')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('stock')->nullable();  // null = unlimited
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
