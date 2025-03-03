<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Assunto;
use App\Models\User;

class AssuntoTest extends TestCase
{
    use RefreshDatabase; // Garante que o banco de dados é resetado a cada teste


    public function test_pode_listar_assuntos()
    {
        $user = User::factory()->create(); // Criar usuário
        $this->actingAs($user); // Simular login

        Assunto::factory()->count(5)->create();

        $response = $this->get(route('assuntos.index'));

        $response->assertStatus(200);
        $response->assertViewHas('assuntos');
    }

    
    public function test_pode_criar_um_assunto()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $dados = ['Descricao' => 'Ação'];

        // Enviar um POST para criar um assunto
        $response = $this->post(route('assuntos.store'), $dados);

        // Verificar se foi salvo no banco
        $this->assertDatabaseHas('Assunto', $dados);

        // Redirecionar para a lista com mensagem de sucesso
        $response->assertRedirect(route('assuntos.index'));
        $response->assertSessionHas('success', 'Assunto adicionado com sucesso!');
    }

    
    public function test_nao_pode_criar_assunto_sem_nome()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('assuntos.store'), ['Descricao' => '']);

        // Verificar se há erro de validação
        $response->assertSessionHasErrors(['Descricao']);
    }

    
    public function test_pode_editar_um_assunto()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $assunto = Assunto::factory()->create();

        $dadosAtualizados = ['Descricao' => 'Terror'];

        $response = $this->put(route('assuntos.update', $assunto->CodAs), $dadosAtualizados);

        // Verificar se os dados foram atualizados no banco
        $this->assertDatabaseHas('Assunto', $dadosAtualizados);

        $response->assertRedirect(route('assuntos.index'));
        $response->assertSessionHas('success', 'Assunto atualizado com sucesso!');
    }

    
    public function test_pode_deletar_um_assunto()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $assunto = Assunto::factory()->create();

        $response = $this->delete(route('assuntos.destroy', $assunto->CodAs));

        // Verificar se o assunto foi removido do banco
        $this->assertDatabaseMissing('Assunto', ['CodAs' => $assunto->CodAs]);

        $response->assertRedirect(route('assuntos.index'));
        $response->assertSessionHas('success', 'Assunto deletado com sucesso!');
    }
}
