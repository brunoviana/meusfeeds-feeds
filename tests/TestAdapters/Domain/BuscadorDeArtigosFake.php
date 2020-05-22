<?php

namespace MeusFeeds\Feeds\Tests\TestAdapters\Domain;

use MeusFeeds\Feeds\Domain\Entities\Feed;
use MeusFeeds\Feeds\Domain\Entities\Artigo;
use MeusFeeds\Feeds\Domain\ValueObjects\Data;
use MeusFeeds\Feeds\Domain\ValueObjects\Autor;
use MeusFeeds\Feeds\Domain\Interfaces\BuscadorDeArtigosInterface;

class BuscadorDeArtigosFake implements BuscadorDeArtigosInterface
{
    public function buscarTodos(Feed $feed) : array
    {
        if ($feed->linkRss() == 'https://brunoviana.dev/rss.xml') {
            return [
                Artigo::novo(
                    'Hello World',
                    'Meu primeiro artigo',
                    'https://brunoviana.net/hello-world',
                    new Autor('Bruno Viana'),
                    new Data(2020, 01, 01),
                    $feed->id(),
                    Artigo::NAO_LIDO
                ),
                Artigo::novo(
                    'Hello Brasil',
                    'Meu segundo artigo',
                    'https://brunoviana.net/hello-brasil',
                    new Autor('Bruno Viana'),
                    new Data(2020, 02, 01),
                    $feed->id(),
                    Artigo::NAO_LIDO
                ),
                Artigo::novo(
                    'Hello Ceará',
                    'Meu terceiro artigo',
                    'https://brunoviana.net/hello-ceara',
                    new Autor('Bruno Viana'),
                    new Data(2020, 03, 01),
                    $feed->id(),
                    Artigo::NAO_LIDO
                ),
            ];
        }

        return [];
    }

    public function buscarNovos(Feed $feed) : array
    {
        if ($feed->linkRss() == 'https://brunoviana.dev/rss.xml') {
            return [
                Artigo::novo(
                    'Hello World',
                    'Meu primeiro artigo',
                    'https://brunoviana.net/hello-world',
                    new Autor('Bruno Viana'),
                    new Data(2020, 01, 01),
                    $feed->id(),
                    Artigo::LIDO
                ),
            ];
        }

        return [];
    }
}
