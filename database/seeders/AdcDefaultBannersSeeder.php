<?php
namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdcDefaultBannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banner_config')->insert([
            [
                'id' => 1,
                'ativo' => true,
                'titulo' => 'Vacinação',
                'imagem' => 'images/banners/vacinaCovid19.png',
                'valor' => 'https://coronavirus.ceara.gov.br/vacina',
                'tipo' => 'webview',
                'ordem' => 1,
                'options' => json_encode(
                    [
                        'localImage' => 'app',
                        'labelAnalytics' => 'banner_vacina_covid19'
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'ativo' => true,
                'titulo' => 'Guia de Assistência Farmacêutica',
                'imagem' => 'images/banners/guiaAssistenciaFarmaceutica.jpg',
                'valor' => 'https://coronavirus.ceara.gov.br/project/secretaria-de-saude-disponibiliza-guia-da-assistencia-farmaceutica-no-estado-do-ceara/',
                'tipo' => 'webview',
                'ordem' => 2,
                'options' => json_encode(
                    [
                        'localImage' => 'app',
                        'labelAnalytics' => 'guia_assistencia_farmaceutica'
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'ativo' => true,
                'titulo' => 'ID Saúde',
                'imagem' => 'images/banners/IDSaude.png',
                'valor' => 'PERFIL',
                'tipo' => 'rota',
                'ordem' => 3,
                'options' => json_encode(
                    [
                        'localImage' => 'app',
                        'login' => true,
                        'labelAnalytics' => 'id_saude'
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'ativo' => true,
                'titulo' => 'ID Saúde',
                'imagem' => 'images/banners/IDSaude.png',
                'valor' => 'LOGIN',
                'tipo' => 'rota',
                'ordem' => 3,
                'options' => json_encode(
                    [
                        'localImage' => 'app',
                        'login' => false,
                        'labelAnalytics' => 'id_saude'
                    ]
                ),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
