<?php

namespace spec\CollegeFB\Iterators;

use PhpSpec\ObjectBehavior;

class GameSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(array());
    }

    public function it_is_possible_to_add_entities()
    {
        $this->append(array('home_team' => 'Test'));

        $this->count()->shouldBeEqualTo(1);

        $this->offsetGet(0)->shouldHaveType('CollegeFB\Entities\Game');
    }

    public function it_is_possible_to_add_more_than_one_game_at_once()
    {
        $this->addGames(array(
            array('home_team' => 'Test'),
            array('home_team' => 'Test2'),
            array('home_team' => 'Test3'),
        ));

        $this->count()->shouldBeEqualTo(3);

        $this->offsetGet(0)->shouldHaveType('CollegeFB\Entities\Game');
    }
}
