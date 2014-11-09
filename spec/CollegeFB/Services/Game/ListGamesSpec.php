<?php

namespace spec\CollegeFB\Services\Game;

use PhpSpec\ObjectBehavior;
use CollegeFB\Repositories\GameInterface;
use CollegeFB\Factories\Game as GameFactory;
use CollegeFB\Iterators\Game as GameIterator;

class ListGamesSpec extends ObjectBehavior
{
    public function let(GameInterface $repository, GameFactory $factory)
    {
        $repository->listAll(0, 25)->willReturn(new GameIterator(array(1, 2)));

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\Game\ListGames');
    }

    public function it_return_the_list_of_games_requested()
    {
        $this->run(array('page' => 0))->shouldReturnAnInstanceOf('CollegeFB\Iterators\Game');
    }
}
