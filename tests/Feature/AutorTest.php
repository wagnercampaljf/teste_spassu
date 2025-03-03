<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Autor;
use App\Models\User;

class AutorTest extends TestCase
{
    use RefreshDatabase; // Garante que o banco de dados é resetado a cada teste


    public function test_pode_listar_autores()
    {
        $user = User::factory()->create(); // Criar usuário
        $this->actingAs($user); // Simular login

        Autor::factory()->count(5)->create();

        $response = $this->get(route('autores.index'));

        $response->assertStatus(200);
        $response->assertViewHas('autores');
    }

    
    public function test_pode_criar_um_autor()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $dados = ['Nome' => 'J. R. R. Tolkien'];

        // Enviar um POST para criar um autor
        $response = $this->post(route('autores.store'), $dados);

        // Verificar se foi salvo no banco
        $this->assertDatabaseHas('Autor', $dados);

        // Redirecionar para a lista com mensagem de sucesso
        $response->assertRedirect(route('autores.index'));
        $response->assertSessionHas('success', 'Autor adicionado com sucesso!');
    }

    
    public function test_nao_pode_criar_autor_sem_nome()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('autores.store'), ['Nome' => '']);

        // Verificar se há erro de validação
        $response->assertSessionHasErrors(['Nome']);
    }

    
    public function test_pode_editar_um_autor()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $autor = Autor::factory()->create();

        $dadosAtualizados = ['Nome' => 'George Orwell'];

        $response = $this->put(route('autores.update', $autor->CodAu), $dadosAtualizados);

        // Verificar se os dados foram atualizados no banco
        $this->assertDatabaseHas('Autor', $dadosAtualizados);

        $response->assertRedirect(route('autores.index'));
        $response->assertSessionHas('success', 'Autor atualizado com sucesso!');
    }

    
    public function test_pode_deletar_um_autor()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $autor = Autor::factory()->create();

        $response = $this->delete(route('autores.destroy', $autor->CodAu));

        // Verificar se o autor foi removido do banco
        $this->assertDatabaseMissing('Autor', ['CodAu' => $autor->CodAu]);

        $response->assertRedirect(route('autores.index'));
        $response->assertSessionHas('success', 'Autor deletado com sucesso!');
    }
}
