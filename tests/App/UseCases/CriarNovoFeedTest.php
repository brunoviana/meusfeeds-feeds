<?php

namespace MeusFeeds\Feeds\Tests\App\UseCases;

use MeusFeeds\Feeds\Tests\TestCase;

use MeusFeeds\Feeds\Domain\Entities\Feed;
use MeusFeeds\Feeds\App\UseCases\CriarNovoFeed;
use MeusFeeds\Feeds\App\Requests\CriarNovoFeedRequest;

use MeusFeeds\Feeds\App\Responses\CriarNovoFeedResponse;
use MeusFeeds\Feeds\Tests\TestAdapters\Domain\FeedRepositoryFake;
use MeusFeeds\Feeds\Tests\TestAdapters\Domain\ArtigoRepositoryFake;

use MeusFeeds\Feeds\Tests\TestAdapters\Domain\BuscadorDeArtigosFake;

class CriarNovoFeedTest extends TestCase
{
    protected $feedRepositoryFake;

    protected $artigoRepositoryFake;

    protected $buscadorDeArtigos;

    public function setUp() : void
    {
        $this->feedRepositoryFake = new FeedRepositoryFake();
        $this->artigoRepositoryFake = new ArtigoRepositoryFake();
        $this->buscadorDeArtigosFake = new BuscadorDeArtigosFake();
    }

    public function test_Deve_Criar_Novo_Feed_Com_Sucesso()
    {
        $criarNovoFeed = new CriarNovoFeed(
            new CriarNovoFeedRequest(
                'Blog do Bruno',
                'https://brunoviana.dev/rss.xml'
            ),
            $this->feedRepositoryFake,
            $this->artigoRepositoryFake,
            $this->buscadorDeArtigosFake
        );

        $resposta = $criarNovoFeed->executar();

        $this->assertInstanceOf(CriarNovoFeedResponse::class, $resposta);
        $this->assertInstanceOf(Feed::class, $resposta->feed());
        $this->assertEquals(1, $resposta->feed()->id());
        $this->assertEquals('Blog do Bruno', $resposta->feed()->titulo());
        $this->assertEquals('https://brunoviana.dev/rss.xml', $resposta->feed()->linkRss());
    }
}
