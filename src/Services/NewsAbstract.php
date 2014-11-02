<?php

namespace CollegeFB\Services;

use CollegeFB\Repositories\NewsInterface;
use CollegeFB\Factories\News as NewsFactory;

abstract class NewsAbstract
{
    protected $repository;
    protected $factory;

    public function __construct(NewsInterface $repository, NewsFactory $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    abstract public function run(array $options);
}
