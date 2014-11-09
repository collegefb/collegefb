<?php

namespace CollegeFB\Services\Game;

use CollegeFB\Services\GameAbstract;

class UpdateGame extends GameAbstract
{
    public function run(array $options)
    {
        $game = $this->factory->gameEntity($options);

        if ((false === $game->hasId()) || (false === $this->gameExists($game->getId()))) {
            throw new \RuntimeException('Game not found in database');
        }

        return $this->repository->save($game);
    }

    private function gameExists($game_id)
    {
        return (false !== $this->repository->getById($game_id));
    }
}
