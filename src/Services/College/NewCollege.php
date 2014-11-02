<?php

namespace CollegeFB\Services\College;

use CollegeFB\Services\CollegeAbstract;

class NewCollege extends CollegeAbstract
{
    public function run(array $options)
    {
        $college = $this->factory->collegeEntity($options);
        if (false !== $this->collegeExists($college->getName(), $college->getNickname())) {
            throw new \RuntimeException('College already exists in database');
        }

        return $this->repository->save($college);
    }

    private function collegeExists($college_name, $college_nickname)
    {
        $college = $this->repository->getByName($college_name);
        if (false !== $college) {
            return ($college->getNickname() === $college_nickname);
        }

        return false;
    }
}
