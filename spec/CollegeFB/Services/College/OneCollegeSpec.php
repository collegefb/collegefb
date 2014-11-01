<?php

namespace spec\CollegeFB\Services\College;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use CollegeFB\Repositories\CollegeInterface;
use CollegeFB\Factories\College as CollegeFactory;
use CollegeFB\Entities\College as CollegeEntity;

class OneCollegeSpec extends ObjectBehavior
{
    public function let(CollegeInterface $repository, CollegeFactory $factory)
    {
        $college = new CollegeEntity();
        $repository->getById(Argument::any())->willReturn($college);
        $repository->getByUrl(Argument::any())->willReturn($college);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\College\OneCollege');
    }

    public function it_get_one_college_given_its_id()
    {
        $this->run(array('college_id' => 1))->shouldReturnAnInstanceOf('CollegeFB\Entities\College');
    }

    public function it_get_one_college_given_its_url()
    {
        $this->run(array('college_url' => 1))->shouldReturnAnInstanceOf('CollegeFB\Entities\College');
    }

    public function it_return_null_when_no_college_id_neither_url_is_given()
    {
        $this->run(array())->shouldBe(null);
    }
}
