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
        Schema::create('Livro_Assunto', function (Blueprint $table) {
            $table->unsignedBigInteger('Livro_CodLi');
            $table->unsignedBigInteger('Assunto_CodAs');
            
            $table->foreign('Livro_CodLi') 
                  ->references('CodLi') 
                  ->on('Livro')
                  ->onDelete('cascade');

            $table->foreign('Assunto_CodAs') 
                  ->references('CodAs') 
                  ->on('Assunto')
                  ->onDelete('cascade');

            $table->primary(['Livro_CodLi', 'Assunto_CodAs']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Livro_Assunto');
    }
};
