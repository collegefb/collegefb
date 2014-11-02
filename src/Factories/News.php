<?php

namespace CollegeFB\Factories;

use CollegeFB\Entities\News as NewsEntity;
use CollegeFB\Iterators\News as NewsIterator;
use CollegeFB\Repositories\MongoDB\News as NewsRepositoryMongoDB;
use CollegeFB\Repositories\NewsInterface;
use CollegeFB\Services\News\NewNews as NewNewsService;
use CollegeFB\Services\News\UpdateNews as UpdateNewsService;
use CollegeFB\Services\News\ListNews as ListNewsService;
use CollegeFB\Services\News\OneNews as OneNewsService;
use CollegeFB\Services\News\RemoveNews as RemoveNewsService;
use MongoDB;

class News
{
    public function newsEntity(array $news_info = array())
    {
        return new NewsEntity($news_info);
    }

    public function newsRepository($database)
    {
        if ($database instanceof MongoDB) {
            return new NewsRepositoryMongoDB($database);
        }

        return null;
    }

    public function newsIterator(array $news)
    {
        return new NewsIterator($news);
    }

    public function newNewsService(NewsInterface $repository)
    {
        return new NewNewsService($repository, $this);
    }

    public function updateNewsService(NewsInterface $repository)
    {
        return new UpdateNewsService($repository, $this);
    }

    public function listNewsService(NewsInterface $repository)
    {
        return new ListNewsService($repository, $this);
    }

    public function oneNewsService(NewsInterface $repository)
    {
        return new OneNewsService($repository, $this);
    }

    public function removeNewsService(NewsInterface $repository)
    {
        return new RemoveNewsService($repository, $this);
    }
}
