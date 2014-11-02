<?php

namespace CollegeFB\Services\News;

use CollegeFB\Services\NewsAbstract;

class RemoveNews extends NewsAbstract
{
    public function run(array $options)
    {
        if (false === ($news = $this->newsExists($options['news_id']))) {
            throw new \RuntimeException('News not found in database');
        }

        return $this->repository->remove($news);
    }

    private function newsExists($news_id)
    {
        return $this->repository->getById($news_id);
    }
}
