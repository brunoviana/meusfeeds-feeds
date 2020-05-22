<?php

namespace MeusFeeds\Feeds\Tests\TestAdapters\Domain;

use MeusFeeds\Feeds\Domain\Entities\Artigo;
use MeusFeeds\Feeds\Domain\Repositories\ArtigoRepositoryInterface;

class ArtigoRepositoryFake implements ArtigoRepositoryInterface
{
    private $artigos = [];

    public function todos() : array
    {
        return $this->artigos;
    }

    public function salvar(Artigo $artigo) : void
    {
        $this->artigos[] = $artigo;

        $artigo->id(
            count($this->artigos)
        );
    }

    public function salvarVarios(array $artigos) : void
    {
        foreach ($artigos as $artigo) {
            $this->salvar($artigo);
        }
    }
}
