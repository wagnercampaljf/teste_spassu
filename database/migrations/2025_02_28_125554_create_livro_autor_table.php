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
        Schema::create('Livro_Autor', function (Blueprint $table) {
            $table->unsignedBigInteger('Livro_CodLi');
            $table->unsignedBigInteger('Autor_CodAu');
            
            $table->foreign('Livro_CodLi') 
                  ->references('CodLi') 
                  ->on('Livro')
                  ->onDelete('cascade');

            $table->foreign('Autor_CodAu') 
                  ->references('Cod') 
                  ->on('Autor')
                  ->onDelete('cascade');

            $table->primary(['Livro_CodLi', 'Autor_CodAu']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Livro_Autor');
    }
};
