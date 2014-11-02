<?php

namespace CollegeFB\Factories;

use CollegeFB\Entities\College as CollegeEntity;
use CollegeFB\Iterators\College as CollegeIterator;
use CollegeFB\Repositories\MongoDB\College as CollegeRepositoryMongoDB;
use CollegeFB\Repositories\CollegeInterface;
use CollegeFB\Services\College\NewCollege as NewCollegeService;
use CollegeFB\Services\College\UpdateCollege as UpdateCollegeService;
use CollegeFB\Services\College\ListColleges as ListCollegesService;
use CollegeFB\Services\College\OneCollege as OneCollegeService;
use MongoDB;

class College
{
    public function collegeEntity(array $college_info = array())
    {
        return new CollegeEntity($college_info);
    }

    public function collegeRepository($database)
    {
        if ($database instanceof MongoDB) {
            return new CollegeRepositoryMongoDB($database);
        }

        return null;
    }

    public function collegeIterator(array $colleges)
    {
        return new CollegeIterator($colleges);
    }

    public function newCollegeService(CollegeInterface $repository)
    {
        return new NewCollegeService($repository, $this);
    }

    public function updateCollegeService(CollegeInterface $repository)
    {
        return new UpdateCollegeService($repository, $this);
    }

    public function listCollegesService(CollegeInterface $repository)
    {
        return new ListCollegesService($repository, $this);
    }

    public function oneCollegeService(CollegeInterface $repository)
    {
        return new OneCollegeService($repository, $this);
    }
}
