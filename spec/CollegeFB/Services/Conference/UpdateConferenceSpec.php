<?php

namespace spec\CollegeFB\Services\Conference;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use CollegeFB\Repositories\ConferenceInterface;
use CollegeFB\Factories\Conference as ConferenceFactory;
use CollegeFB\Entities\Conference as ConferenceEntity;

class UpdateConferenceSpec extends ObjectBehavior
{
    public function let(ConferenceInterface $repository, ConferenceFactory $factory)
    {
        $conference_to_save = new ConferenceEntity();
        $factory->conferenceEntity(array())->willReturn($conference_to_save);

        $non_existing_conference = new ConferenceEntity();
        $non_existing_conference->setId('non_existing');
        $factory->conferenceEntity(array('name' => 'fails'))->willReturn($non_existing_conference);

        $repository->getById(null)->willReturn(true);
        $repository->getById('non_existing')->willReturn(false);
        $repository->save(Argument::any())->willReturnArgument(0);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\Conference\UpdateConference');
    }

    public function it_should_save_existing_conference()
    {
        $this->run(array())->shouldReturnAnInstanceOf('CollegeFB\Entities\Conference');
    }

    public function it_should_fail_when_trying_to_save_a_non_existing_conference()
    {
        $this->shouldThrow('\RuntimeException')->duringRun(array('name' => 'fails'));
    }
}
