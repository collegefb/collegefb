<?php

namespace spec\CollegeFB\Iterators;

use PhpSpec\ObjectBehavior;

class ConferenceSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(array());
    }

    public function it_is_possible_to_add_entities()
    {
        $this->append(array('name' => 'Test'));

        $this->count()->shouldBeEqualTo(1);

        $this->offsetGet(0)->shouldHaveType('CollegeFB\Entities\Conference');
    }

    public function it_is_possible_to_add_more_than_one_conference_at_once()
    {
        $this->addConferences(array(
            array('name' => 'Test'),
            array('name' => 'Test2'),
            array('name' => 'Test3'),
        ));

        $this->count()->shouldBeEqualTo(3);

        $this->offsetGet(0)->shouldHaveType('CollegeFB\Entities\Conference');
    }
}
