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
        // Remover a view antes de recriá-la
        DB::statement("DROP VIEW IF EXISTS view_relatorio_livros");

        DB::statement("
            CREATE VIEW view_relatorio_livros AS
                select	Autor.Nome,
                        Livro.CodLi,
                        Livro.Titulo,
                        Livro.Edicao,
                        Livro.Editora,
                        Livro.Valor,
                        Livro.AnoPublicacao,
                        (
                        select 	GROUP_CONCAT(DISTINCT Autor.Nome ORDER BY Autor.Nome ASC SEPARATOR ', ') AS Autores
                        from	Livro_Autor
                                inner join Autor on Autor.CodAu = Livro_Autor.Autor_CodAu
                        where	Livro_Autor.Livro_CodLi = Livro.CodLi
                        ) AS Autores,
                        (
                        select 	GROUP_CONCAT(DISTINCT Assunto.Descricao ORDER BY Assunto.Descricao ASC SEPARATOR ', ') AS Assuntos
                        from	Livro_Assunto
                                inner join Assunto on Assunto.CodAs = Livro_Assunto.Assunto_CodAs
                        where	Livro_Assunto.Livro_CodLi = Livro.CodLi
                        ) AS Assuntos
                from	Livro
                        inner join Livro_Autor on Livro.CodLi = Livro_Autor.Livro_CodLi
                        inner join Autor on Livro_Autor.Autor_CodAu = Autor.CodAu
                order by
                        Autor.nome,
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
