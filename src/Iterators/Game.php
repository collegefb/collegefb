<?php

namespace CollegeFB\Iterators;

use CollegeFB\Entities\Game as GameEntity;
use ArrayIterator;

class Game extends ArrayIterator
{
    public function append($value)
    {
        if (!empty($value['_id'])) {
            $value['id'] = (string) $value['_id'];
            unset($value['_id']);
        }

        parent::append(new GameEntity($value));
    }

    public function addGames(array $games_list)
    {
        foreach ($games_list as $game) {
            $this->append($game);
        }
    }
}
