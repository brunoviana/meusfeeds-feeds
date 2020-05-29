<?php

namespace MeusFeeds\Feeds\Tests\App\UseCases;

use MeusFeeds\Feeds\Tests\TestCase;

use MeusFeeds\Feeds\Domain\Entities\Artigo;
use MeusFeeds\Feeds\Domain\ValueObjects\Data;
use MeusFeeds\Feeds\Domain\ValueObjects\Autor;
use MeusFeeds\Feeds\App\UseCases\AlterarLidoDoArtigo;
use MeusFeeds\Feeds\App\Requests\AlterarLidoDoArtigoRequest;
use MeusFeeds\Feeds\Tests\TestAdapters\Domain\ArtigoRepositoryFake;

class AlterarLidoDoArtigoTest extends TestCase
{
    protected $artigoRepositoryFake;

    public function setUp() : void
    {
        $this->artigoRepositoryFake = new ArtigoRepositoryFake();
    }

    public function test_Deve_Alterar_Artigo_Para_Lido_Corretamente()
    {
        $artigo = new Artigo(
            'Hello World',
            'Meu primeiro artigo',
            'https://brunoviana.net/hello-world',
            new Autor('Bruno Viana'),
            new Data(2020, 01, 01),
            1,
            Artigo::NAO_LIDO
        );

        $this->assertFalse($artigo->lido());

        $this->artigoRepositoryFake->salvar($artigo);

        $alterarLidoDoArtigo = new AlterarLidoDoArtigo(
            new AlterarLidoDoArtigoRequest(
                1,
                Artigo::LIDO
            ),
            $this->artigoRepositoryFake
        );

        $alterarLidoDoArtigo->executar();

        $this->assertTrue($artigo->lido());
    }

    public function test_Deve_Alterar_Artigo_Para_NAO_Lido_Corretamente()
    {
        $artigo = new Artigo(
            'Hello World',
            'Meu primeiro artigo',
            'https://brunoviana.net/hello-world',
            new Autor('Bruno Viana'),
            new Data(2020, 01, 01),
            1,
            Artigo::LIDO
        );

        $this->assertTrue($artigo->lido());

        $this->artigoRepositoryFake->salvar($artigo);

        $alterarLidoDoArtigo = new AlterarLidoDoArtigo(
            new AlterarLidoDoArtigoRequest(
                1,
                Artigo::NAO_LIDO
            ),
            $this->artigoRepositoryFake
        );

        $alterarLidoDoArtigo->executar();

        $this->assertFalse($artigo->lido());
    }
}
