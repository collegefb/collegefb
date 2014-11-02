<?php

namespace CollegeFB\Services\News;

use CollegeFB\Services\NewsAbstract;

class NewNews extends NewsAbstract
{
    public function run(array $options)
    {
        if (isset($options['_id'])) {
            unset($options['_id']);
        }

        $news = $this->factory->newsEntity($options);
        if (false !== $this->newsExists($news->getLink())) {
            throw new \RuntimeException('News already exists in database');
        }

        return $this->repository->save($news);
    }

    private function newsExists($news_link)
    {
        return (false !== $this->repository->getByLink($news_link));
    }
}
