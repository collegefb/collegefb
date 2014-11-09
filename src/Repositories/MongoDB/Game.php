<?php

namespace CollegeFB\Repositories\MongoDB;

use CollegeFB\Repositories\GameInterface;
use CollegeFB\Entities\Game as GameEntity;
use CollegeFB\Iterators\Game as GameIterator;
use MongoDB;
use MongoId;
use MongoDate;

class Game implements GameInterface
{
    const COLLECTION_NAME = 'games';

    private $collection;
    private $query_params = array();

    public function __construct(MongoDB $connection)
    {
        $this->collection = $connection->selectCollection(self::COLLECTION_NAME);
    }

    public function save(GameEntity $game)
    {
        $game_info = $game->getData();

        if ((false !== $game->hasId()) && (null !== ($id = $game->getId()))) {
            $game_info['_id'] = new MongoId($id);
        } else {
            $game_info['_id'] = new MongoId();
            $game->setId($game_info['_id']);
        }

        $game_info['date'] = new MongoDate($game_info['date']);

        $this->collection->save($game_info);

        return $game;
    }

    public function remove(GameEntity $game)
    {
        $id = $game->getId();

        return (!empty($id)) ? $this->collection->remove(array('_id' => $id)) : null;
    }

    public function getById($game_id)
    {
        $id = new MongoId($game_id);

        $game_info = $this->collection->findOne(array('_id' => $id));

        return (!empty($game_info)) ? new GameEntity($game_info) : false;
    }

    public function getByDateAndTeams($game_date, $home_team, $road_team)
    {
        $game_date = new MongoDate($game_date);

        $game_info = $this->collection->findOne(array(
            'date'          => $game_date,
            'home_team'     => $home_team,
            'road_team'     => $road_team,
        ));

        return (!empty($game_info)) ? new GameEntity($game_info) : false;
    }

    public function setQueryParams($param, $value)
    {
        if (!empty($value)) {
            $this->query_params[$param] = $value;
        }
    }

    public function listAll($page, $limit)
    {
        $games = $this->collection->find($this->query_params)->sort(array('date' => -1))->skip($page * $limit)->limit($limit);

        $game_iterator = new GameIterator();

        $game_iterator->addGames(iterator_to_array($games));

        return $game_iterator;
    }
}
