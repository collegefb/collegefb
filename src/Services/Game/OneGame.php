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

        }

        return $game_data;
    }
}
