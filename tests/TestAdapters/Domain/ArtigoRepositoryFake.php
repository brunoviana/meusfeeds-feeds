<?php

namespace MeusFeeds\Feeds\Tests\TestAdapters\Domain;

use MeusFeeds\Feeds\Domain\Entities\Artigo;
use MeusFeeds\Feeds\Domain\Repositories\ArtigoRepositoryInterface;

class ArtigoRepositoryFake implements ArtigoRepositoryInterface
{
    private $artigos = [];

    public function buscarPeloId(int $id) : ?Artigo
    {
        foreach ($this->artigos as $artigo) {
            if ($artigo->id() == $id) {
                return $artigo;
            }
        }
    }

    public function todos() : array
    {
        return $this->artigos;
    }

    public function salvar(Artigo $artigo) : void
    {
        if (!$artigo->id()) {
            $this->artigos[] = $artigo;

            $artigo->id(
                count($this->artigos)
            );
        }
    }

    public function salvarVarios(array $artigos) : void
    {
        foreach ($artigos as $artigo) {
            $this->salvar($artigo);
        }
    }
}
