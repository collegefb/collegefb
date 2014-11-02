<?php

namespace CollegeFB\Services\College;

use CollegeFB\Services\CollegeAbstract;

class UpdateCollege extends CollegeAbstract
{
    public function run(array $options)
    {
        $college = $this->factory->collegeEntity($options);

        if ((false === $college->hasId()) || (false === $this->collegeExists($college->getId()))) {
            throw new \RuntimeException('College not found in database');
        }

        return $this->repository->save($college);
    }

    private function collegeExists($college_id)
    {
        return (false !== $this->repository->getById($college_id));
    }
}
