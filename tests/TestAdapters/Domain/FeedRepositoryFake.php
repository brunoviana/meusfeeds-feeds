<?php

namespace MeusFeeds\Feeds\Tests\TestAdapters\Domain;

use MeusFeeds\Feeds\Domain\Entities\Feed;
use MeusFeeds\Feeds\Domain\Repositories\FeedRepositoryInterface;

class FeedRepositoryFake implements FeedRepositoryInterface
{
    private $feeds = [];

    public function buscar(int $id)
    {
        foreach ($this->feeds as $feed) {
            if ($feed->id() == $id) {
                return $feed;
            }
        }

        return null;
    }

    public function buscarPeloLink(string $link)
    {
        foreach ($this->feeds as $feed) {
            if ($feed->linkRss() == $link) {
                return $feed;
            }
        }

        return null;
    }

    public function salvar(Feed $feed) : void
    {
        $this->feeds[] = $feed;

        $feed->id(
            count($this->feeds)
        );
    }
}
