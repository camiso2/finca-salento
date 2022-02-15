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
     * sreturn name aleatory according param the entry
     *
     * @param Int $digit
     * @return String
     */
    public function test_funcionality_for_generate_names_aleatories_diferente_to_null()
    {
        //dado el siguiente parametro
        $param = 15;

        //cuando enviamos el parametro
        $service = new RandomName();
        $response = $service->randomName($param);

        //entonces verifica que no devuelve null
         $this->assertNotNull($response);
    }
}
