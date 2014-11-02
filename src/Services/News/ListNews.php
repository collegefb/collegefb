<?php

namespace CollegeFB\Services\News;

use CollegeFB\Services\NewsAbstract;

class ListNews extends NewsAbstract
{
    const LIMIT = 25;

    public function run(array $options)
    {
        $page = !empty($options['page']) ? $options['page'] : 0;
        $limit = !empty($options['limit']) ? $options['limit'] : self::LIMIT;

        if (!empty($options['origin_id'])) {
            $this->repository->setQueryParams('origin_id', $options['origin_id']);
        }
        if (!empty($options['origin'])) {
            $this->repository->setQueryParams('origin', $options['origin']);
        }

        return $this->repository->listAll($page, $limit);
    }
}
