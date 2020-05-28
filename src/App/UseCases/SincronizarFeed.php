<?php

namespace MeusFeeds\Feeds\App\UseCases;

use MeusFeeds\Feeds\Domain\Services\FeedService;
use MeusFeeds\Feeds\App\Requests\SincronizarFeedRequest;
use MeusFeeds\Feeds\Domain\Interfaces\BuscadorDeArtigosInterface;

use MeusFeeds\Feeds\Domain\Repositories\ArtigoRepositoryInterface;

class SincronizarFeed
{
    private $request;

    private $buscadorDeArtigos;

    private $artigoRepository;

    public function __construct(
        SincronizarFeedRequest $request,
        ArtigoRepositoryInterface $artigoRepository,
        BuscadorDeArtigosInterface $buscadorDeArtigos
    ) {
        $this->request = $request;
        $this->artigoRepository = $artigoRepository;
        $this->buscadorDeArtigos = $buscadorDeArtigos;
    }

    public function executar()
    {
        $feed = $this->request->feed();

        $artigos = $this->buscadorDeArtigos->buscarNovos($feed);

        if ($artigos) {
            $this->artigoRepository->salvarVarios($artigos);
        }
    }
}
