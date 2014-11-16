<?php

namespace CollegeFB\Services\Game;

use CollegeFB\Services\GameAbstract;

class OneGame extends GameAbstract
{
    public function run(array $options)
    {
        $game_data = null;
        if (!empty($options['game_id'])) {

            $game_data = $this->repository->getById($options['game_id']);

        } elseif (!empty($options['game_date']) && !empty($options['game_home_team']) && !empty($options['game_road_team'])) {
            $game_data = $this->repository->getByDateAndTeams($options['game_date'], $options['game_home_team'], $options['game_road_team']);
        }

        return $game_data;
    }
}
