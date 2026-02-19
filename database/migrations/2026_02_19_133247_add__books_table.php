<?php

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
        Schema::create('Books', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('isbn')->unique();
                $table->integer('total_copies');
                $table->integer('available_copies');
                $table->boolean('status')->default(true);
                $table->timestamps();
        });

        Schema::create('Loans', function (Blueprint $table) {
                $table->id();
                $table->string('nombre');
                $table->dateTime('fecha_hora_prestamo');
                $table->dateTime('fecha_hora_devolucion')->nullable();
                $table->foreignId('book_id')->constrained('Books')->onDelete('cascade');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Loans');
        Schema::dropIfExists('Books');
    }
};
