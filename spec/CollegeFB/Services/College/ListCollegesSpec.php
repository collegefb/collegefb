<?php

namespace spec\CollegeFB\Services\College;

use PhpSpec\ObjectBehavior;
use CollegeFB\Repositories\CollegeInterface;
use CollegeFB\Factories\College as CollegeFactory;

class ListCollegesSpec extends ObjectBehavior
{
    public function let(CollegeInterface $repository, CollegeFactory $factory)
    {
        $repository->listAll(0, 25)->willReturn(array(1, 2));

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\College\ListColleges');
    }

    public function it_return_the_list_of_colleges_requested()
    {
        $this->run(array('page' => 0))->shouldReturnAnInstanceOf('ArrayIterator');
    }
}
