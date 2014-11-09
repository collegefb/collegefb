<?php

namespace CollegeFB\Factories;

use CollegeFB\Entities\Game as GameEntity;
use CollegeFB\Iterators\Game as GameIterator;
use CollegeFB\Repositories\MongoDB\Game as GameRepositoryMongoDB;
use CollegeFB\Repositories\GameInterface;
use CollegeFB\Services\Game\NewGame as NewGameService;
use CollegeFB\Services\Game\UpdateGame as UpdateGameService;
use CollegeFB\Services\Game\ListGames as ListGamesService;
use CollegeFB\Services\Game\OneCGame as OneGameService;
use MongoDB;

class Game
{
    public function gameEntity(array $game_info = array())
    {
        return new GameEntity($game_info);
    }

    public function gameRepository($database)
    {
        if ($database instanceof MongoDB) {
            return new GameRepositoryMongoDB($database);
        }

        return null;
    }

    public function gameIterator(array $games)
    {
        return new GameIterator($games);
    }

    public function newGameService(GameInterface $repository)
    {
        return new NewGameService($repository, $this);
    }

    public function updateGameService(GameInterface $repository)
    {
        return new UpdateGameService($repository, $this);
    }

    public function listGamesService(GameInterface $repository)
    {
        return new ListCollegesService($repository, $this);
    }

    public function oneGameService(GameInterface $repository)
    {
        return new OneGameService($repository, $this);
    }
}
