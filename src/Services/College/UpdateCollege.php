<?php

namespace CollegeFB\Services\College;

use CollegeFB\Services\CollegeAbstract;

class UpdateCollege extends CollegeAbstract
{
    public function run(array $options)
    {
        $college = $this->factory->collegeEntitie($options);

        if ((false === $college->hasId()) || (false === $this->collegeExists($college->getName()))) {
            throw new \RuntimeException('College not found in database');
        }

        return $this->repository->save($college);
    }

    private function collegeExists($college_name)
    {
        return (false !== $this->repository->getByName($college_name));
    }
}
