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
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('category', ['agricola', 'artesanal'])->index();
            $table->string('name', 120);
            $table->string('producer_name', 120);
            $table->decimal('price', 8, 2);
            $table->enum('unit', ['kilo', 'unidad', 'arroba']);
            $table->string('location', 180);
            $table->string('description', 300)->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
