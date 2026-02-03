<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Triagem;
use App\Models\Medico;
use App\Models\Remedio;
use App\Models\Estoque;
use App\Models\Prescricao;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;

class FluxoAtendimentoTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Simulando as permissões (Gates) para focar na lógica do status
        Gate::define('enfermeiro', fn($user) => $user->perfil === 'enfermeiro');
        Gate::define('medico', fn($user) => $user->perfil === 'medico');
        Gate::define('farmaceutico', fn($user) => $user->perfil === 'farmaceutico');
    }

    /** * CENÁRIO 1: Enfermeiro finaliza a triagem
     * O status deve nascer como "aguardando_atendimento" (valor default do banco)
     */
    public function test_triagem_nova_deve_ter_status_aguardando_atendimento()
    {
        // 1. Cria usuário enfermeiro e paciente
        $enfermeiro = User::factory()->create(['perfil' => 'enfermeiro']);
        $paciente = Paciente::factory()->create();

        // 2. Dados Completos para passar na validação do Controller
        $dadosTriagem = [
            'paciente_id' => $paciente->id,
            'manchester_classificacao' => 'Pouco Urgente',
            'glasgow' => 15,
            'pressao_sistolica' => 120,
            'pressao_diastolica' => 80,
            'temperatura' => 36.5,
            'frequencia_cardiaca' => 80,
            'spo2' => '98%',
            'glicemia' => 90,
            'peso' => 70.0,
            'altura_cm' => 170,
            'escore_dor' => 0,
            'queixa_principal' => 'Teste Automatizado',
            'tipo_chegada' => 'Espontanea',
            // O status NÃO é enviado aqui, pois o banco deve definir o default
        ];

        // 3. Ação: Post na rota que você confirmou no web.php ('triagem.store')
        $this->actingAs($enfermeiro)
             ->post(route('triagem.store'), $dadosTriagem) 
             ->assertSessionHas('success');

        // 4. Verificação: Confere se o status gravado foi o padrão "aguardando_atendimento"
        $this->assertDatabaseHas('triagens', [
            'paciente_id' => $paciente->id,
            'status' => 'aguardando_atendimento'
        ]);
    }

    /** * CENÁRIO 2: Médico gera prescrição
     * O status deve mudar de "em_atendimento" (ou aguardando) para "aguardando_medicamentos"
     */
    public function test_ao_gerar_prescricao_status_muda_para_aguardando_medicamentos()
    {
        $userMedico = User::factory()->create(['perfil' => 'medico']);
        $medico = Medico::factory()->create(['user_id' => $userMedico->id]);
        $paciente = Paciente::factory()->create();

        // Cria uma triagem anterior (estado inicial)
        Triagem::factory()->create([
            'paciente_id' => $paciente->id,
            'status' => 'em_atendimento', // Médico já puxou o paciente
            'atendido' => false
        ]);

        $dadosPrescricao = [
            'id_paciente' => $paciente->id,
            'observacao' => 'Tomar remédio em casa',
            'medicamentos' => [] // Mesmo sem remédios, a lógica do controller deve atualizar o status
        ];

        $this->actingAs($userMedico)
             ->post(route('criar.prescricao'), $dadosPrescricao); // Ajuste para rota correta do MedicoController

        // VERIFICAÇÃO: Atualizou para aguardando remédios?
        $this->assertDatabaseHas('triagens', [
            'paciente_id' => $paciente->id,
            'status' => 'aguardando_medicamentos',
            'atendido' => true, // O controller também marca como atendido pelo médico
            'medico_id' => $medico->id
        ]);
    }

    /** * CENÁRIO 3: Farmacêutico entrega TUDO (Totalmente Atendido)
     * O status deve mudar para "finalizado"
     */
    public function test_farmacia_entrega_tudo_e_status_muda_para_finalizado()
    {
        $farmaceutico = User::factory()->create(['perfil' => 'farmaceutico']);
        $paciente = Paciente::factory()->create();
        
        // 1. Prepara a Triagem no estado de espera da farmácia
        $triagem = Triagem::factory()->create([
            'paciente_id' => $paciente->id,
            'status' => 'aguardando_medicamentos'
        ]);

        // 2. Prepara Remédio e Estoque SUFICIENTE
        $remedio = Remedio::factory()->create(['nome' => 'Dipirona']);
        Estoque::create(['id_remedio' => $remedio->id, 'quantidade' => 50, 'lote' => 'L1']);

        // 3. Cria a Prescrição pedindo esse remédio
        $prescricao = Prescricao::create([
            'id_medico' => Medico::factory()->create()->id, // Cria médico dummy
            'id_paciente' => $paciente->id,
            'data_prescricao' => now(),
            'prescricao_atendida' => 'nao_atendido'
        ]);
        
        // Pivô: Prescrição pede 10 unidades
        $prescricao->remedios()->attach($remedio->id, [
            'quantidade' => 10,
            'unidade_medida' => 'cp',
            'intervalo' => '8/8h',
            'duracao' => '1 dia',
            'qtd_tomar' => '1',
            'atendido' => false
        ]);

        // 4. AÇÃO: Farmacêutico entrega o remédio (seleciona o checkbox)
        $this->actingAs($farmaceutico)
             ->post(route('marcar.prescricao.atendida', $prescricao->id), [
                 'remedios' => [$remedio->id] // Envia o ID do remédio atendido
             ]);

        // VERIFICAÇÃO FINAL:
        // A prescrição deve estar "atendido"
        $this->assertDatabaseHas('prescricoes', [
            'id' => $prescricao->id,
            'prescricao_atendida' => 'atendido'
        ]);

        // A TRIAGEM deve estar "finalizado"
        $this->assertDatabaseHas('triagens', [
            'id' => $triagem->id,
            'status' => 'finalizado'
        ]);
    }
}