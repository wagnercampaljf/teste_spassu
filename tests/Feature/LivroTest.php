<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Livro;
use App\Models\Autor;
use App\Models\Assunto;
use App\Models\User;

class LivroTest extends TestCase
{
    use RefreshDatabase; // Garante que o banco de dados é resetado a cada teste

    public function test_pode_listar_livros()
    {
        $user = User::factory()->create(); // Criar usuário
        $this->actingAs($user); // Simular login

        Livro::factory()->count(5)->create();

        $response = $this->get(route('livros.index'));

        $response->assertStatus(200);
        $response->assertViewHas('livros');
    }

    public function test_pode_criar_um_livro()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $autores = Autor::factory()->count(2)->create(); // Criar autores
        $assuntos = Assunto::factory()->count(2)->create(); // Criar assuntos

        $dados = [
            'Titulo' => 'O Senhor dos Anéis',
            'Editora' => 'HarperCollins',
            'Edicao' => '2',
            'AnoPublicacao' => 1954,
            'Valor' => 'R$ 99,90',
            'Autores' => $autores->pluck('CodAu')->toArray(),
            'Assuntos' => $assuntos->pluck('CodAs')->toArray(),
        ];

        // Enviar um POST para criar um livro
        $response = $this->post(route('livros.store'), $dados);

        // Verificar se foi salvo no banco
        $this->assertDatabaseHas('Livro', ['Titulo' => 'O Senhor dos Anéis']);

        // Redirecionar para a lista com mensagem de sucesso
        $response->assertRedirect(route('livros.index'));
        $response->assertSessionHas('success', 'Livro adicionado com sucesso!');
    }

    public function test_nao_pode_criar_livro_sem_titulo()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('livros.store'), [
            'Titulo' => '',
            'Editora' => 'HarperCollins',
            'Edicao' => '2',
            'AnoPublicacao' => 1954,
            'Valor' => 'R$ 99,90',
        ]);

        // Verificar se há erro de validação
        $response->assertSessionHasErrors(['Titulo']);
    }

    public function test_pode_editar_um_livro()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $livro = Livro::factory()->create();
        $autores = Autor::factory()->count(2)->create();
        $assuntos = Assunto::factory()->count(2)->create();

        // Novo valor numérico correto
        $valorConvertido = 12.50;

        // Novos dados para atualização
        $dadosAtualizados = [
            'Titulo' => '1984',
            'Editora' => 'Companhia das Letras',
            'Edicao' => $livro->Edicao,
            'AnoPublicacao' => $livro->AnoPublicacao,
            'Valor' => 'R$ 12,50',
            'Autores' => $autores->pluck('CodAu')->toArray(),
            'Assuntos' => $assuntos->pluck('CodAs')->toArray(),
        ];

        $response = $this->put(route('livros.update', $livro->CodLi), $dadosAtualizados);

        // Atualizar a instância do livro no banco
        $livro->refresh();

        // Verificar se os dados foram atualizados corretamente no banco
        $this->assertEquals('1984', $livro->Titulo);
        $this->assertEquals('Companhia das Letras', $livro->Editora);
        $this->assertEquals($valorConvertido, $livro->Valor); 

        $response->assertRedirect(route('livros.index'));
        $response->assertSessionHas('success', 'Livro atualizado com sucesso!');
    }

    public function test_pode_deletar_um_livro()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $livro = Livro::factory()->create();

        $response = $this->delete(route('livros.destroy', $livro->CodLi));

        // Verificar se o livro foi removido do banco
        $this->assertDatabaseMissing('Livro', ['CodLi' => $livro->CodLi]);

        $response->assertRedirect(route('livros.index'));
        $response->assertSessionHas('success', 'Livro deletado com sucesso!');
    }
}
