<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('commerce_id')
                ->constrained('commerces')
                ->cascadeOnDelete();

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->decimal('discount_percentage', 5, 2)->default(0);
            $table->string('status')->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Revierte la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
