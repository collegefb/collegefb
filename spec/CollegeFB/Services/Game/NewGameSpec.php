<?php

namespace spec\CollegeFB\Services\Game;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use CollegeFB\Repositories\GameInterface;
use CollegeFB\Factories\Game as GameFactory;
use CollegeFB\Entities\Game as GameEntity;

class NewGameSpec extends ObjectBehavior
{
    public function let(GameInterface $repository, GameFactory $factory)
    {
        $game_to_save = new GameEntity();
        $game_to_save->setDate(1);
        $factory->gameEntity(array())->willReturn($game_to_save);

        $game_to_save_that_fails = new GameEntity();
        $factory->gameEntity(array('home_team' => 'fails'))->willReturn($game_to_save_that_fails);

        $game_saved = new GameEntity();
        $repository->getById(Argument::any())->willReturn($game_saved);
        $repository->getByDateAndTeams(1, null, null)->willReturn(false);
        $repository->getByDateAndTeams(null, null, null)->willReturn(true);
        $repository->save($game_to_save)->willReturnArgument(0);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\Game\NewGame');
    }

    public function it_save_a_game_when_does_not_exist()
    {
        $this->run(array())->shouldReturnAnInstanceOf('CollegeFB\Entities\Game');
    }

    public function it_fails_when_game_exists()
    {
        $this->shouldThrow('\RuntimeException')->duringRun(array('home_team' => 'fails'));
    }
}
