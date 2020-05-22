<?php

namespace MeusFeeds\Feeds\App\UseCases;

use MeusFeeds\Feeds\Domain\Entities\Feed;
use MeusFeeds\Feeds\Domain\Services\FeedService;
use MeusFeeds\Feeds\App\Requests\CriarNovoFeedRequest;
use MeusFeeds\Feeds\App\Responses\CriarNovoFeedResponse;
use MeusFeeds\Feeds\Domain\Repositories\FeedRepositoryInterface;

use MeusFeeds\Feeds\Domain\Interfaces\BuscadorDeArtigosInterface;
use MeusFeeds\Feeds\Domain\Repositories\ArtigoRepositoryInterface;

class CriarNovoFeed
{
    private $request;

    private $buscadorDeArtigos;

    private $artigoRepository;

    private $feedRepository;

    public function __construct(
        CriarNovoFeedRequest $request,
        FeedRepositoryInterface $feedRepository,
        ArtigoRepositoryInterface $artigoRepository,
        BuscadorDeArtigosInterface $buscadorDeArtigos
    ) {
        $this->request = $request;
        $this->feedRepository = $feedRepository;
        $this->artigoRepository = $artigoRepository;
        $this->buscadorDeArtigos = $buscadorDeArtigos;
    }

    public function executar()
    {
        $feed = $this->criaFeed();

        return $this->responder($feed);
    }

    public function criaFeed()
    {
        $feedService = new FeedService();

        $feedService->setBuscadorDeArtigos($this->buscadorDeArtigos);
        $feedService->setFeedRepository($this->feedRepository);
        $feedService->setArtigoRepository($this->artigoRepository);

        return $feedService->criarNovoFeed(
            $this->request->titulo(),
            $this->request->linkRss()
        );
    }

    public function responder(Feed $feed)
    {
        return new CriarNovoFeedResponse($feed);
    }
}
