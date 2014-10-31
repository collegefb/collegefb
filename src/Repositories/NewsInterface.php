<?php

namespace CollegeFB\Repositories;

use CollegeFB\Entities\News as NewsEntity;

interface NewsInterface
{
    public function save(NewsEntity $news);

    public function remove(NewsEntity $news);

    public function setQueryParams($param, $value);

    public function listAll($page, $limit);

    public function getByLink($news_link);

    public function getById($news_id);
}
