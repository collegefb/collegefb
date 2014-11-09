<?php

namespace CollegeFB\Repositories;

use CollegeFB\Entities\Game as GameEntity;

interface GameInterface
{
    public function save(GameEntity $game);

    public function remove(GameEntity $game);

    public function getById($game_id);

    public function getByDateAndTeams($game_date, $home_team, $road_team);

    public function setQueryParams($param, $value);

    public function listAll($page, $limit);
}
