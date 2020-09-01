<?php

namespace Tests\Feature;

use App\Model\CategoriaProfissional;
use App\Model\Estado;
use App\Model\UnidadeServico;
use App\Model\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private function getUser()
    {
        $this->seed();

        $fakerBrasil = new Generator();
        $fakerBrasil->addProvider(new \Faker\Provider\pt_BR\Person($fakerBrasil));

        $faker = Factory::create();
        $estado = Estado::find($faker->numberBetween(1, 27));
        $municipio = $estado->municipios()->first();

        $unidadesDeServico = UnidadeServico::whereNotNull('pai');
        $unidades = $unidadesDeServico->first();

        $categoriasProfissional = CategoriaProfissional::all();
        $categoriaProfissional = $categoriasProfissional->first();
        return [
            'email' => $faker->email,
            'nomeCompleto' => $faker->name(),
            'senha' => '12345678',
            'repetirsenha' => '12345678',
            'telefone' => $faker->randomNumber(9),
            'cpf' => $fakerBrasil->cpf(false),
            'rg' => $fakerBrasil->rg(false),
            'estadoId' => $estado->id,
            'estado' => $estado->nome,
            'cidadeId' => $municipio->id,
            'cidade' => $municipio->nome,
            'termos' => 'true',
            'categoriaProfissional' => json_encode($categoriaProfissional),
            'titulacaoAcademica' => '[{"id":1,"nome":"Titulação 1"},{"id":2,"nome":"Titulação 2"}]',
            'tipoContratacao' => '[{"id":1,"nome":"Estatutário"},{"id":2,"nome":"Cooperado"}]',
            'instituicao' => '[{"id":1,"nome":"ESP 1"},{"id":2,"nome":"HGF 2"}]',
            'unidadeServico' => json_encode([$unidades])
        ];
    }

    public function testCadastroProfissionalSemDados()
    {
        $response = $this->json('POST', 'api/user', [
        ]);
        $response->assertOk();
        $response->assertJsonFragment([
            'sucesso' => false
        ]);
    }

    public function testCadastroProfissional()
    {
        $users = User::all();
        foreach ($users as $user) {
            foreach ($user->unidadesServicos as $userUnidadeServico) {
                $userUnidadeServico->delete();
            }
            $user->delete();
        }

        $user = $this->getUser();

        $response = $this->json('POST', 'api/user', $user);
        $response->assertOk();
        $response->assertJsonFragment([
            'sucesso' => true,
            'mensagem' => 'Usuário cadastrado com sucesso'
        ]);
    }
}