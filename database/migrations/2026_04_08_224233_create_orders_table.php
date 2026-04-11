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

            // Relaciones
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Datos del pedido
            $table->dateTime('fecha_pedido');
            $table->dateTime('fecha_entrega')->nullable();

            $table->enum('estado', ['pendiente', 'cancelado'])
                  ->default('pendiente');

            // Totales
            $table->decimal('total', 10, 2)->default(0);
            $table->decimal('descuento', 10, 2)->default(0);

            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};