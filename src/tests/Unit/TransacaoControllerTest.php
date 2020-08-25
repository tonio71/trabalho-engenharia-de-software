<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Produto;
use App\Transacao;
use Illuminate\Support\InteractsWithTime;
use Illuminate\Support\Str;
use Tests\TestCase;

class TransacaoControllerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->withoutExceptionHandling();
    }

    public function testAdd()
    {
        $empresa = Empresa::all()->toArray();
        $lengthEmpresa = count($empresa) + 1;

        $produto = Produto::all()->toArray();
        $lengthProduto = count($produto) + 1;

        $response = $this->postJson('/api/transacao/adicionar',
            [
                "empresa" => rand(1, $lengthEmpresa-1),
                "produto" => rand(1, $lengthProduto-1),
                "quantidade" => rand(1, 10000),
                "data" => "2020-08-25 01:09:40",
                "valor" => rand(0, 10000),
                "condicao" => array_rand(["Aberta", "Fechada"]),
            ]
        );

        $response
            ->assertStatus(200);
    }
}
