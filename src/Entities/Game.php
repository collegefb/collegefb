<?php

namespace CollegeFB\Entities;

class Game extends EntityAbstract
{
    protected $data = array(
        '_id'                 => null,
        'date'                => null,
        'home_team'           => null,
        'road_team'           => null,
        'home_score'          => null,
        'road_score'          => null,
        'home_record'         => null,
        'road_record'         => null,
    );

    public function __construct($game_data = null)
    {
        if (is_array($game_data)) {

            foreach ($game_data as $key => $value) {
                $method = 'set' . $this->toCamelCase($key);
                call_user_func(array($this, $method), $value);
            }

        }
    }
}
