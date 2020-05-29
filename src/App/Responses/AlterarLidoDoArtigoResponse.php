<?php

namespace MeusFeeds\Feeds\App\Responses;

class AlterarLidoDoArtigoResponse
{
    private bool $sucesso;

    public function __construct(bool $sucesso)
    {
        $this->sucesso = $sucesso;
    }

    public function sucesso()
    {
        return $this->sucesso;
    }
}
