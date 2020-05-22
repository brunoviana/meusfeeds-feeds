<?php

namespace MeusFeeds\Feeds\Domain\Interfaces;

use MeusFeeds\Feeds\Domain\Entities\Feed;

interface BuscadorDeArtigosInterface
{
    public function buscarTodos(Feed $feed) : array;

    public function buscarNovos(Feed $feed) : array;
}
