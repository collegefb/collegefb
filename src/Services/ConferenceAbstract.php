<?php

namespace CollegeFB\Services;

use CollegeFB\Repositories\ConferenceInterface;
use CollegeFB\Factories\Conference as ConferenceFactory;

abstract class ConferenceAbstract
{
    protected $repository;
    protected $factory;

    public function __construct(ConferenceInterface $repository, ConferenceFactory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    abstract public function run(array $options);
}
