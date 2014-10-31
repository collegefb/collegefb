<?php

namespace CollegeFB\Iterators;

use CollegeFB\Entities\News as NewsEntity;
use ArrayIterator;

class News extends ArrayIterator
{
    public function append($value)
    {
        if (!empty($value['_id'])) {
            $value['id'] = (string) $value['_id'];
            unset($value['_id']);
        }

        parent::append(new NewsEntity($value));
    }

    public function addNews(array $news_list)
    {
        foreach ($news_list as $news) {
            $this->append($news);
        }
    }
}
