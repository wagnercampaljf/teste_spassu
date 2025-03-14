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
        Schema::create('Livro', function (Blueprint $table) {
            $table->bigIncrements('CodLi'); // Define 'Cod' como chave primária autoincremental
            $table->string('Titulo');
            $table->string('Editora');
            $table->integer('Edicao');
            $table->year('AnoPublicacao');
            $table->decimal('Valor', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Livro');
    }
};
