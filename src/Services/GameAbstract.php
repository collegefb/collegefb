<?php

namespace CollegeFB\Services;

use CollegeFB\Repositories\GameInterface;
use CollegeFB\Factories\Game as GameFactory;

abstract class GameAbstract
{
    protected $repository;
    protected $factory;

    public function __construct(GameInterface $repository, GameFactory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    abstract public function run(array $options);
}
