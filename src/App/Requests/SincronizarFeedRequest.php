<?php

namespace MeusFeeds\Feeds\App\Requests;

use MeusFeeds\Feeds\Domain\Entities\Feed;

class SincronizarFeedRequest
{
    private Feed $feed;

    public function __construct(Feed $feed)
    {
        $this->feed = $feed;
    }

    public function feed()
    {
        return $this->feed;
    }
}
