<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('alerts', function (Blueprint $table) {
        $table->id();

        // FK
        $table->foreignId('product_id')->constrained()->onDelete('cascade');

        // Datos de la alerta
        $table->enum('type', ['bajo', 'critico', 'agotado']);
        $table->enum('severity', ['baja', 'media', 'alta']);
        $table->string('message');

        $table->enum('status', ['activa', 'resuelta', 'ignorada'])->default('activa');

        $table->timestamp('resolved_at')->nullable();

        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('alerts');
}


};
