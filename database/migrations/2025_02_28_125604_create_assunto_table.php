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
        Schema::create('assuntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('Assunto', function (Blueprint $table) {
            $table->bigIncrements('CodAs'); // Define 'Cod' como chave primária autoincremental
            $table->string('Descricao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Assunto');
    }
};
