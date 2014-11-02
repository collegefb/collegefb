<?php

namespace CollegeFB\Services\News;

use CollegeFB\Services\NewsAbstract;

class UpdateNews extends NewsAbstract
{
    public function run(array $options)
    {
        $news = $this->factory->newsEntity($options);

        if ((false === $news->hasId()) || (false === $this->newsExists($news->getId()))) {
            throw new \RuntimeException('News not found in database');
        }

        return $this->repository->save($news);
    }

    private function newsExists($news_id)
    {
        return (false !== $this->repository->getById($news_id));
    }
}
