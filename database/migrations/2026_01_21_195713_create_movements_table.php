<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->id();

            // FK
            $table->foreignId('product_id')
                  ->constrained()
                  ->cascadeOnDelete(); // si se elimina producto, sí se elimina movimiento

            $table->foreignId('user_id')
                  ->nullable() // 👈 IMPORTANTE
                  ->constrained()
                  ->nullOnDelete(); // 👈 SOLUCIÓN

            $table->foreignId('movement_type_id')
                  ->constrained()
                  ->restrictOnDelete(); // 👈 recomendado

            $table->foreignId('movement_reason_id')
                  ->constrained()
                  ->restrictOnDelete(); // 👈 recomendado

            // Datos del movimiento
            $table->integer('quantity');
            $table->string('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movements');
    }
};