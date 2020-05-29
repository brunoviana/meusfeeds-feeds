<?php

namespace MeusFeeds\Feeds\App\UseCases;

use MeusFeeds\Feeds\Domain\Entities\Feed;
use MeusFeeds\Feeds\App\Requests\CriarNovoFeedRequest;
use MeusFeeds\Feeds\App\Responses\CriarNovoFeedResponse;
use MeusFeeds\Feeds\Domain\Repositories\FeedRepositoryInterface;
use MeusFeeds\Feeds\App\Exceptions\FeedJaExisteException;
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
        $titulo = $this->request->titulo();
        $linkRss = $this->request->linkRss();

        $feedEncontrado = $this->feedRepository->buscarPeloLink(
            $linkRss
        );

        if ($feedEncontrado) {
            throw new FeedJaExisteException('Este feed já está cadastrado');
        }

        $feed = new Feed($titulo, $linkRss);

        $this->feedRepository->salvar($feed);

        $artigos = $this->buscadorDeArtigos->buscarTodos($feed);

        if ($artigos) {
            $this->artigoRepository->salvarVarios($artigos);
        }

        return $this->responder($feed);
    }

    public function responder(Feed $feed)
    {
        return new CriarNovoFeedResponse($feed);
    }
}
