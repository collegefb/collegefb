<?php

namespace spec\CollegeFB\Services\Conference;

use PhpSpec\ObjectBehavior;
use CollegeFB\Repositories\ConferenceInterface;
use CollegeFB\Factories\Conference as ConferenceFactory;
use CollegeFB\Entities\Conference as ConferenceEntity;

class NewConferenceSpec extends ObjectBehavior
{
    public function let(ConferenceInterface $repository, ConferenceFactory $factory)
    {
        $conference_to_save = new ConferenceEntity();
        $factory->conferenceEntity(array())->willReturn($conference_to_save);

        $conference_to_save_that_fails = new ConferenceEntity();
        $conference_to_save_that_fails->setName('Test');
        $factory->conferenceEntity(array('name' => 'fails'))->willReturn($conference_to_save_that_fails);

        $repository->getByName(null)->willReturn(false);
        $repository->save($conference_to_save)->willReturnArgument(0);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\Conference\NewConference');
    }

    public function it_save_a_conference_when_does_not_exist()
    {
        $this->run(array())->shouldReturnAnInstanceOf('CollegeFB\Entities\Conference');
    }

    public function it_fails_when_conference_exists()
    {
        $this->shouldThrow('\RuntimeException')->duringRun(array('name' => 'fails'));
    }
}
