<?php

namespace CollegeFB\Services\College;

use CollegeFB\Services\CollegeAbstract;

class ListColleges extends CollegeAbstract
{
    const LIMIT = 25;

    public function run(array $options)
    {
        $limit = !empty($options['limit']) ? $options['limit'] : self::LIMIT;
        $page = !empty($options['page']) ? $options['page'] : 0;

        $conference = !empty($options['conference']) ? $options['conference'] : null;

        if (!is_null($conference)) {

            $this->repository->setQueryParams('conference', $conference);

        }

        return $this->repository->listAll($page, $limit);
    }
}
