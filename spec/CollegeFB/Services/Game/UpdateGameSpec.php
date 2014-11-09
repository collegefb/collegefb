<?php

namespace spec\CollegeFB\Services\Game;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use CollegeFB\Repositories\GameInterface;
use CollegeFB\Factories\Game as GameFactory;
use CollegeFB\Entities\Game as GameEntity;

class UpdateGameSpec extends ObjectBehavior
{
    public function let(GameInterface $repository, GameFactory $factory)
    {
        $game_to_save = new GameEntity();
        $factory->gameEntity(array())->willReturn($game_to_save);

        $non_existing_game = new GameEntity();
        $non_existing_game->setId('non_existing');
        $factory->gameEntity(array('home_team' => 'fails'))->willReturn($non_existing_game);

        $repository->getById(null)->willReturn(true);
        $repository->getById('non_existing')->willReturn(false);
        $repository->save(Argument::any())->willReturnArgument(0);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\Game\UpdateGame');
    }

    public function it_should_save_existing_game()
    {
        $this->run(array())->shouldReturnAnInstanceOf('CollegeFB\Entities\Game');
    }

    public function it_should_fail_when_trying_to_save_a_non_existing_game()
    {
        $this->shouldThrow('\RuntimeException')->duringRun(array('home_team' => 'fails'));
    }
}
