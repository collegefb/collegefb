<?php

namespace spec\CollegeFB\Services\Conference;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use CollegeFB\Repositories\ConferenceInterface;
use CollegeFB\Factories\Conference as ConferenceFactory;
use CollegeFB\Entities\Conference as ConferenceEntity;

class RemoveConferenceSpec extends ObjectBehavior
{
    public function let(ConferenceInterface $repository, ConferenceFactory $factory)
    {
        $repository->getById(null)->willReturn(new ConferenceEntity());
        $repository->getById('non_existing')->willReturn(false);
        $repository->remove(Argument::any())->willReturn(true);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\Conference\RemoveConference');
    }

    public function it_is_possible_to_remove_an_existing_conference()
    {
        $this->run(array('conference_id' => null))->shouldBe(true);
    }

    public function it_fails_when_trying_to_remove_non_existing_conference()
    {
        $this->shouldThrow('\RuntimeException')->duringRun(array('conference_id' => 'non_existing'));
    }
}
