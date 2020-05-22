<?php

namespace MeusFeeds\Feeds\App\Responses;

use MeusFeeds\Feeds\Domain\Entities\Feed;

class CriarNovoFeedResponse
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
