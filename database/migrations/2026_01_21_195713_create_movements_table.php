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
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('movement_type_id')->constrained()->onDelete('cascade');
        $table->foreignId('movement_reason_id')->constrained()->onDelete('cascade');

        // Datos del movimiento
        $table->integer('quantity');
        $table->string('notes')->nullable();

        $table->timestamps(); // creado y actualizado
    });
}

public function down(): void
{
    Schema::dropIfExists('movements');
}

};
