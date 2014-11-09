<?php

namespace CollegeFB\Services\Game;

use CollegeFB\Services\GameAbstract;

class NewGame extends GameAbstract
{
    public function run(array $options)
    {
        $game = $this->factory->gameEntity($options);
        if (false !== $this->gameExists($game->getDate(), $game->getHomeTeam(), $game->getRoadTeam())) {
            throw new \RuntimeException('Game already exists in database');
        }

        return $this->repository->save($game);
    }

    private function gameExists($game_date, $game_home_team, $game_road_team)
    {
        return (false !== $this->repository->getByDateAndTeams($game_date, $game_home_team, $game_road_team));
    }
}
