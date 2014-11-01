<?php

namespace CollegeFB\Services\College;

use CollegeFB\Services\CollegeAbstract;
use ArrayIterator;

class ListColleges extends CollegeAbstract
{
    const LIMIT = 25;

    public function run(array $options)
    {
        $limit = !empty($options['limit']) ? $options['limit'] : self::LIMIT;
        $colleges = $this->repository->listAll($options['page'], $limit);

        $found = new ArrayIterator();
        foreach ($colleges as $college) {
            $found->append($college);
        }

        return $found;
    }
}
