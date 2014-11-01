<?php

namespace CollegeFB\Services\College;

use CollegeFB\Services\CollegeAbstract;

class OneCollege extends CollegeAbstract
{
    public function run(array $options)
    {
        $college_data = null;
        if (!empty($options['college_id'])) {

            $college_data = $this->getById($options['college_id']);

        } elseif (!empty($options['college_url'])) {

            $college_data = $this->getByUrl($options['college_url']);

        }

        return $college_data;
    }

    private function getById($college_id)
    {
        return $this->repository->getById($college_id);
    }

    private function getByUrl($college_url)
    {
        return $this->repository->getByUrl($college_url);
    }
}
