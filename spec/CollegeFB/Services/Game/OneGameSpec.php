<?php

namespace spec\CollegeFB\Services\Game;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use CollegeFB\Repositories\GameInterface;
use CollegeFB\Factories\Game as GameFactory;
use CollegeFB\Entities\Game as GameEntity;

class OneGameSpec extends ObjectBehavior
{
    public function let(GameInterface $repository, GameFactory $factory)
    {
        $game = new GameEntity();
        $repository->getById(Argument::any())->willReturn($game);
        $repository->getByDateAndTeams(Argument::any(), Argument::any(), Argument::any())->willReturn($game);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\Game\OneGame');
    }

    public function it_get_one_game_given_its_id()
    {
        $this->run(array('game_id' => 1))->shouldReturnAnInstanceOf('CollegeFB\Entities\Game');
    }

    public function it_return_null_when_no_game_id_neither_url_is_given()
    {
        $this->run(array())->shouldBe(null);
    }

    public function it_get_one_game_given_its_date_and_teams()
    {
        $this->run(array(
            'game_date'         => 1234,
            'game_home_team'    => 'Test',
            'game_road_team'    => 'Test',
        ))->shouldReturnAnInstanceOf('CollegeFB\Entities\Game');
    }
}
