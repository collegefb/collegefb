<?php

namespace CollegeFB\Services\News;

use CollegeFB\Services\NewsAbstract;

class OneNews extends NewsAbstract
{
    public function run(array $options)
    {
        $news_data = null;

        if (!empty($options['news_id'])) {

            $news_data = $this->getById($options['news_id']);

        } elseif (!empty($options['news_url'])) {

            $news_data = $this->getByLink($options['news_url']);

        }

        return $news_data;
    }

    private function getById($news_id)
    {
        return $this->repository->getById($news_id);
    }

    private function getByLink($news_url)
    {
        return $this->repository->getByLink($news_url);
    }
}
