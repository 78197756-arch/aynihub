<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();       // comprador
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('producer_id')->constrained('users')->cascadeOnDelete();
            $table->string('product_name', 120);   // copia: el pedido conserva el nombre aunque se borre el producto
            $table->string('unit', 20);
            $table->decimal('unit_price', 8, 2);
            $table->unsignedInteger('quantity');
            $table->decimal('total', 10, 2);
            $table->enum('status', ['pendiente', 'confirmado', 'enviado', 'entregado', 'cancelado'])->default('pendiente');
            $table->string('note', 255)->nullable();
            $table->timestamps();

            $table->index(['producer_id', 'status']);
            $table->index(['user_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
