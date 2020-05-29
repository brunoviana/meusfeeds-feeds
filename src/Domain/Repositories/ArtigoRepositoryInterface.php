<?php

namespace MeusFeeds\Feeds\Domain\Repositories;

use MeusFeeds\Feeds\Domain\Entities\Artigo;

interface ArtigoRepositoryInterface
{
    public function buscarPeloId(int $id) : ?Artigo;
    
    public function todos() : array;

    public function salvar(Artigo $feed) : void;

    public function salvarVarios(array $artigos) : void;
}
