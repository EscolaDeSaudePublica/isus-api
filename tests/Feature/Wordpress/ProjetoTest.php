<?php

namespace Tests\Feature\Wordpress;

use App\Model\Wordpress\App;
use App\Model\Wordpress\Categoria;
use App\Model\Wordpress\Projeto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjetoTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $apps = App::APP;
        foreach ($apps as $key => $app) {
            foreach ($app as $categoriaId) {
                $categoria = factory(Categoria::class)->create([
                    'term_id' => $categoriaId
                ]);

                $categorias = Categoria::all();
                foreach ($categorias as $categoria) {
                    $projeto = factory(Projeto::class)->create([
                        'categoria_id' => $categoria->term_id
                    ]);
                }
            }
        }
    }

    public function testRetornaProjetoSemParametro()
    {
        $response = $this->json('GET', "api/projeto/");
        $response->assertNotFound();
    }

    public function testProjetoComParametroExistente()
    {
        $projetos = Projeto::all();
        $projeto = $projetos->first();

        $response = $this->json('GET', "api/projeto/{$projeto->id}");
        $response->assertJsonStructure([
            'id',
            'slug',
            'post_date',
            'post_title',
            'post_content',
            'image',
            'anexos',
        ]);
        $response->assertOk();
    }
}