<?php

namespace spec\CollegeFB\Entities;

use PhpSpec\ObjectBehavior;

class GameSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Entities\Game');
    }

    public function it_is_possible_to_initialize_the_game_with_data()
    {
        $data = array(
            'home_team'  => 'Test Home',
            'road_team'  => 'Test Road',
        );
        $this->beConstructedWith($data);

        $this->getHomeTeam()->shouldBeEqualTo('Test Home');
        $this->getRoadTeam()->shouldBeEqualTo('Test Road');
    }
}
