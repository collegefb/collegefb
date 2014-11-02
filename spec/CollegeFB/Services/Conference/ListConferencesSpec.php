<?php

namespace spec\CollegeFB\Services\Conference;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use CollegeFB\Repositories\ConferenceInterface;
use CollegeFB\Factories\Conference as ConferenceFactory;
use CollegeFB\Iterators\Conference as ConferenceIterator;

class ListConferencesSpec extends ObjectBehavior
{
    public function let(ConferenceInterface $repository, ConferenceFactory $factory)
    {
        $repository->listAll(0, 25)->willReturn(new ConferenceIterator(array(1, 2)));
        $repository->setQueryParams(Argument::any(), Argument::any())->willReturn(true);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\Conference\ListConferences');
    }

    public function it_should_return_ncaa_conferences()
    {
        $this->run(array('division' => 'd2'))->shouldReturnAnInstanceOf('CollegeFB\Iterators\Conference');
    }

    public function it_should_return_naia_conferences()
    {
        $this->run(array('division' => 'naia'))->shouldReturnAnInstanceOf('CollegeFB\Iterators\Conference');
    }
}
