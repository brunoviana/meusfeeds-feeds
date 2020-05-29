<?php

namespace MeusFeeds\Feeds\App\UseCases;

use MeusFeeds\Feeds\App\Requests\AlterarLidoDoArtigoRequest;
use MeusFeeds\Feeds\Domain\Repositories\ArtigoRepositoryInterface;

class AlterarLidoDoArtigo
{
    private $request;

    private $artigoRepository;

    public function __construct(
        AlterarLidoDoArtigoRequest $request,
        ArtigoRepositoryInterface $artigoRepository
    ) {
        $this->request = $request;
        $this->artigoRepository = $artigoRepository;
    }

    public function executar()
    {
        $artigoId = $this->request->artigoId();
        $lido = (int)$this->request->lido();

        $artigo = $this->artigoRepository->buscarPeloId($artigoId);
        
        $artigo->lido($lido);

        $this->artigoRepository->salvar($artigo);
    }
}
