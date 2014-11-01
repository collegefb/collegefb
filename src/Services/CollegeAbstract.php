<?php

namespace CollegeFB\Services;

use CollegeFB\Repositories\CollegeInterface;
use CollegeFB\Factories\College as CollegeFactory;

abstract class CollegeAbstract
{
    protected $repository;
    protected $factory;

    public function __construct(CollegeInterface $repository, CollegeFactory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    abstract public function run(array $options);
}
