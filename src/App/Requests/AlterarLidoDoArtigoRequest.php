<?php

namespace MeusFeeds\Feeds\App\Requests;

class AlterarLidoDoArtigoRequest
{
    private int $artigoId;

    private int $lido;

    public function __construct(int $artigoId, int $lido)
    {
        $this->artigoId = $artigoId;
        $this->lido = $lido;
    }

    public function artigoId()
    {
        return $this->artigoId;
    }

    public function lido()
    {
        return $this->lido;
    }
}
