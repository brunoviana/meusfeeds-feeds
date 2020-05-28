<?php

namespace MeusFeeds\Feeds\Tests\App\UseCases;

use MeusFeeds\Feeds\Tests\TestCase;
use MeusFeeds\Feeds\Domain\Entities\Feed;

use MeusFeeds\Feeds\Domain\Entities\Artigo;
use MeusFeeds\Feeds\App\UseCases\SincronizarFeed;

use MeusFeeds\Feeds\App\Requests\SincronizarFeedRequest;
use MeusFeeds\Feeds\Tests\TestAdapters\Domain\ArtigoRepositoryFake;

use MeusFeeds\Feeds\Tests\TestAdapters\Domain\BuscadorDeArtigosFake;

class SincronizarFeedTest extends TestCase
{
    protected $extratorDeFeedFake;

    protected $feedRepositoryFake;

    protected $artigoRepositoryFake;

    protected $buscadorDeArtigos;

    public function setUp() : void
    {
        $this->artigoRepositoryFake = new ArtigoRepositoryFake();
        $this->buscadorDeArtigosFake = new BuscadorDeArtigosFake();
    }

    public function test_Deve_Atualizar_Feed_Com_Sucesso()
    {
        $feed = new Feed(
            'Blog do Bruno',
            'https://brunoviana.dev/rss.xml'
        );

        $sincronizaFeed = new SincronizarFeed(
            new SincronizarFeedRequest(
                $feed
            ),
            $this->artigoRepositoryFake,
            $this->buscadorDeArtigosFake
        );

        $sincronizaFeed->executar();

        $artigos = $this->artigoRepositoryFake->todos();

        $this->assertIsArray($artigos);
        $this->assertCount(1, $artigos);
        $this->assertInstanceOf(Artigo::class, $artigos[0]);
    }
}
