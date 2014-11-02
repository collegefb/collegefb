<?php

namespace spec\CollegeFB\Services\Conference;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use CollegeFB\Repositories\ConferenceInterface;
use CollegeFB\Factories\Conference as ConferenceFactory;
use CollegeFB\Entities\Conference as ConferenceEntity;

class OneConferenceSpec extends ObjectBehavior
{
    public function let(ConferenceInterface $repository, ConferenceFactory $factory)
    {
        $conference = new ConferenceEntity();
        $repository->getById(Argument::any())->willReturn($conference);
        $repository->getByUrl(Argument::any())->willReturn($conference);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\Conference\OneConference');
    }

    public function it_get_one_conference_given_its_id()
    {
        $this->run(array('conference_id' => 1))->shouldReturnAnInstanceOf('CollegeFB\Entities\Conference');
    }

    public function it_get_one_conference_given_its_url()
    {
        $this->run(array('conference_url' => 1))->shouldReturnAnInstanceOf('CollegeFB\Entities\Conference');
    }

    public function it_return_null_when_no_conference_id_neither_url_is_given()
    {
        $this->run(array())->shouldBe(null);
    }
}
