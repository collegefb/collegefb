<?php

namespace spec\CollegeFB\Services\College;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use CollegeFB\Repositories\CollegeInterface;
use CollegeFB\Factories\College as CollegeFactory;
use CollegeFB\Entities\College as CollegeEntity;

class UpdateCollegeSpec extends ObjectBehavior
{
    public function let(CollegeInterface $repository, CollegeFactory $factory)
    {
        $college_to_save = new CollegeEntity();
        $factory->collegeEntity(array())->willReturn($college_to_save);

        $non_existing_college = new CollegeEntity();
        $non_existing_college->setName('non_existing');
        $factory->collegeEntity(array('name' => 'fails'))->willReturn($non_existing_college);

        $repository->getByName(null)->willReturn(true);
        $repository->getByName('non_existing')->willReturn(false);
        $repository->save(Argument::any())->willReturnArgument(0);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\College\UpdateCollege');
    }

    public function it_should_save_existing_college()
    {
        $this->run(array())->shouldReturnAnInstanceOf('CollegeFB\Entities\College');
    }

    public function it_should_fail_when_trying_to_save_a_non_existing_college()
    {
        $this->shouldThrow('\RuntimeException')->duringRun(array('name' => 'fails'));
    }
}
