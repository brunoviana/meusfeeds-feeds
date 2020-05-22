<?php

namespace MeusFeeds\Feeds\Domain\Repositories;

use MeusFeeds\Feeds\Domain\Entities\Feed;

interface FeedRepositoryInterface
{
    public function buscar(int $id);

    public function buscarPeloLink(string $link);

    public function salvar(Feed $feed) : void;
}
