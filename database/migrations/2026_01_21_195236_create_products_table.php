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

        // FK
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->foreignId('warehouse_id')->constrained()->onDelete('cascade');

        // Datos del producto
        $table->string('code', 50)->unique();
        $table->string('name', 150);
        $table->integer('stock_actual');
        $table->integer('stock_minimo');
        $table->integer('stock_maximo');
        $table->decimal('precio_unitario', 10, 2);
        $table->enum('status', ['activo', 'inactivo'])->default('activo');

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('products');
}

};
