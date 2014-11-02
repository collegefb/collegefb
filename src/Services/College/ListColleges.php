<?php

namespace CollegeFB\Services\College;

use CollegeFB\Services\CollegeAbstract;

class ListColleges extends CollegeAbstract
{
    const LIMIT = 25;

    public function run(array $options)
    {
        $limit = !empty($options['limit']) ? $options['limit'] : self::LIMIT;

        return $this->repository->listAll($options['page'], $limit);
    }
}
