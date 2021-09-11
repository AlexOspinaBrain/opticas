<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EpsTest extends TestCase
{

    use DatabaseMigrations;
    use WithoutMiddleware;

    public function testEpsCreate()
    {
        $data = $this->getData();
        // Creamos un nuevo usuario y verificamos la respuesta
        $this->post('/eps', $data)
            ->seeJsonEquals(['created' => true]);

        $data = $this->getData(['nombre' => 'jane']);
        // Actualizamos al usuario recien creado (id = 1)
        $this->put('/eps/1', $data)
            ->seeJsonEquals(['updated' => true]);

        // Obtenemos los datos de dicho usuario modificado
        // y verificamos que el nombre sea el correcto
        $this->get('eps/1')->seeJson(['name' => 'jane']);

        // Eliminamos al usuario
        $this->delete('eps/1')->seeJson(['deleted' => true]);
    }

    public function getData($custom = array())
    {
        $data = [
            'nombre'      => 'EPS Alex',
            'codigo'     => 'EPSAlex'
            
            ];
        $data = array_merge($data, $custom);
        return $data;
    }
}