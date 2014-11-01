<?php

namespace spec\CollegeFB\Services\College;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use CollegeFB\Repositories\CollegeInterface;
use CollegeFB\Factories\College as CollegeFactory;
use CollegeFB\Entities\College as CollegeEntity;

class NewCollegeSpec extends ObjectBehavior
{
    public function let(CollegeInterface $repository, CollegeFactory $factory)
    {
        $college_to_save = new CollegeEntity();
        $factory->collegeEntitie(array())->willReturn($college_to_save);

        $college_to_save_that_fails = new CollegeEntity();
        $college_to_save_that_fails->setName('Test');
        $college_to_save_that_fails->setNickname('Test');
        $factory->collegeEntitie(array('name' => 'fails'))->willReturn($college_to_save_that_fails);

        $college_saved = new CollegeEntity();
        $college_saved->setName('Test');
        $college_saved->setNickname('Test');
        $repository->getByName(Argument::any())->willReturn($college_saved);
        $repository->save($college_to_save)->willReturnArgument(0);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\College\NewCollege');
    }

    public function it_save_a_college_when_does_not_exist()
    {
        $this->run(array())->shouldReturnAnInstanceOf('CollegeFB\Entities\College');
    }

    public function it_fails_when_college_exists()
    {
        $this->shouldThrow('\RuntimeException')->duringRun(array('name' => 'fails'));
    }
}
