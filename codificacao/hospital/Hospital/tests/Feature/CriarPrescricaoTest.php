<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Remedio;
use App\Models\Triagem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;

class CriarPrescricaoTest extends TestCase
{
    use RefreshDatabase; 

    protected function setUp(): void
    {
        parent::setUp();
        
        // Simula a Gate 'medico' para permitir o acesso no controller
        Gate::define('medico', function ($user) {
            return true;
        });
    }

    /** @test */
    public function um_medico_pode_criar_uma_prescricao_e_finalizar_a_triagem()
    {
        //PREPARAÇÃO
        
        // Cria o médico e o usuário associado
        $user = User::factory()->create();
        $medico = Medico::factory()->create(['user_id' => $user->id]);

        // cria paciente e uma triagem pendente (atendido = 0 / false)
        $paciente = Paciente::factory()->create();
        $triagem = Triagem::factory()->create([
            'paciente_id' => $paciente->id,
            'atendido' => false,
            'created_at' => now()->subHour(), 
        ]);

        //cria um remedio para prescrever
        $remedio = Remedio::factory()->create();

        //dados que viriam do formulário (Request)
        $payload = [
            'id_paciente' => $paciente->id,
            'observacao' => 'Paciente com sintomas de gripe.',
            'medicamentos' => [
                [
                    'id' => $remedio->id,
                    'quantidade' => 1, 
                    'unidade' => 'cp', 
                    'intervalo' => '8/8h',
                    'duracao' => '5 dias',
                    'qtd_tomar' => '1 comprimido',
                ]
            ]
        ];

        //ação 
        
        $response = $this->actingAs($user)
                         ->post(route('criar.prescricao'), $payload);

        // ASSERÇÕES

        $response->assertRedirect(route('medico.index'));
        $response->assertSessionHas('success');

        // verifica se a prescriçao foi criada no banco
        $this->assertDatabaseHas('prescricoes', [
            'id_medico' => $medico->id,
            'id_paciente' => $paciente->id,
            'observacao' => 'Paciente com sintomas de gripe.',
        ]);

        // Verifica se a Triagem foi atualizada (Atendido = true e Medico ID setado)
        $this->assertDatabaseHas('triagens', [
            'id' => $triagem->id,
            'atendido' => true,
            'medico_id' => $medico->id,
        ]);

        // Verifica se o relacionamento PrescricaoRemedio foi salvo
        $prescricaoCriada = \App\Models\Prescricao::latest()->first();
        
        $this->assertDatabaseHas('prescricao_remedios', [
            'id_prescricao' => $prescricaoCriada->id,
            'id_remedio' => $remedio->id,
            'intervalo' => '8/8h',
            'duracao' => '5 dias',
        ]);
    }
}