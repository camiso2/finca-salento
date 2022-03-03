<?php

namespace Tests\Feature\app\Custom;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Custom\RandomName;

class RandomNameTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

     /**
     * @author Jaiver Andrés  Ocampo
     * @test
     * @group  RandomName method randomName($param)
     */
    public function test_funcionality_for_generate_names_aleatories_diferente_to_null()
    {
        //dado el siguiente valor
        $param = 15;

        //cuando enviamos el parametro 
        $service = new RandomName();
        $response = $service->randomName($param);

        //entonces verifica que no devuelve null
         $this->assertNotNull($response);
    }
}
