<?php

namespace MeusFeeds\Feeds\Tests\Domain\ValueObjects;

use MeusFeeds\Feeds\Tests\TestCase;
use MeusFeeds\Feeds\Domain\ValueObjects\Data;

class DataTest extends TestCase
{
    public function test_Data_Deve_Retornar_Ano_Corretamente()
    {
        $data = new Data(2020, 10, 01);

        $this->assertEquals(2020, $data->ano());
    }

    public function test_Data_Deve_Retornar_Mes_Corretamente()
    {
        $data = new Data(2020, 10, 01);

        $this->assertEquals(10, $data->mes());
    }

    public function test_Data_Deve_Retornar_Dia_Corretamente()
    {
        $data = new Data(2020, 10, 01);

        $this->assertEquals(01, $data->dia());
    }

    public function test_Data_Deve_Retornar_Formato_Padrao_Corretamente()
    {
        $data = new Data(2020, 10, 01);

        $this->assertEquals('2020-10-01', $data->formatoPadrao());
    }

    public function test_Data_Deve_Retornar_Se_Esta_Vazia_Corretamente()
    {
        $this->assertFalse((new Data(2020, 10, 01))->vazio());
        $this->assertTrue((new Data())->vazio());
    }

    public function test_Data_Deve_Retornar_Agora_Corretamente()
    {
        $data = Data::agora();

        $this->assertEquals(date('d'), $data->dia());
        $this->assertEquals(date('m'), $data->mes());
        $this->assertEquals(date('Y'), $data->ano());
    }
}
