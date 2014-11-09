<?php

namespace CollegeFB\Services\Game;

use CollegeFB\Services\GameAbstract;

class ListGames extends GameAbstract
{
    const LIMIT = 25;

    public function run(array $options)
    {
        $limit = !empty($options['limit']) ? $options['limit'] : self::LIMIT;
        $page = !empty($options['page']) ? $options['page'] : 0;

        $home_team = !empty($options['home_team']) ? $options['home_team'] : null;
        if (!is_null($home_team)) {

            $this->repository->setQueryParams('home_team', $home_team);

        }

        $road_team = !empty($options['road_team']) ? $options['road_team'] : null;
        if (!is_null($road_team)) {

            $this->repository->setQueryParams('road_team', $road_team);

        }

        return $this->repository->listAll($page, $limit);
    }
}
