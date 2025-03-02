<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW view_relatorio_livros AS
                select	Livro.CodLi,
                        Livro.Titulo,
                        Livro.Edicao,
                        Livro.Editora,
                        Livro.Valor,
                        Livro.AnoPublicacao,
                        GROUP_CONCAT(DISTINCT Autor.Nome ORDER BY Autor.Nome ASC SEPARATOR ', ') AS Autores,
                        GROUP_CONCAT(DISTINCT Assunto.Descricao ORDER BY Assunto.Descricao ASC SEPARATOR ', ') AS Assuntos
                from	Livro
                        inner join Livro_Autor on Livro.CodLi = Livro_Autor.Livro_CodLi
                        inner join Autor on Livro_Autor.Autor_CodAu = Autor.CodAu
                        inner join Livro_Assunto on Livro.CodLi = Livro_Assunto.Livro_CodLi
                        inner join Assunto on Livro_Assunto.Assunto_CodAs = Assunto.CodAs
                group by
                        Livro.CodLi,
                        Livro.Titulo,
                        Livro.Edicao,
                        Livro.Editora,
                        Livro.Valor,
                        Livro.AnoPublicacao;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS view_relatorio_livros");
    }
};
