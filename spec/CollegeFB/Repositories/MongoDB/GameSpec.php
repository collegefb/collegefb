<?php

namespace spec\CollegeFB\Repositories\MongoDB;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use MongoDB;
use MongoCollection;
use MongoCursor;
use ArrayIterator;
use CollegeFB\Entities\Game as GameEntity;

class GameSpec extends ObjectBehavior
{
    public function let(MongoDB $mongo_db, MongoCollection $mongo_collection, MongoCursor $mongo_cursor)
    {
        $mongo_cursor->sort(Argument::any())->willReturn($mongo_cursor);
        $mongo_cursor->skip(Argument::any())->willReturn($mongo_cursor);
        $mongo_cursor->limit(Argument::any())->willReturn(new ArrayIterator());

        $mongo_collection->save(Argument::any())->willReturn(true);
        $mongo_collection->remove(Argument::any())->willReturn(true);
        $mongo_collection->findOne(Argument::any())->willReturn(true);
        $mongo_collection->find(Argument::any())->willReturn($mongo_cursor);

        $mongo_db->selectCollection('games')->willReturn($mongo_collection);

        $this->beConstructedWith($mongo_db);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Repositories\MongoDB\Game');
    }

    public function it_should_save_a_game_when_given()
    {
        $game = new GameEntity();

        $this->save($game)->shouldBeEqualTo($game);
    }

    public function it_should_be_possible_to_remove_given_game()
    {
        $game = new GameEntity();
        $game->setId(1);

        $this->remove($game)->shouldBe(true);
    }

    public function it_should_return_a_game_when_trying_to_find_by_id()
    {
        $this->getById('5443c7dcc863c7a90f8b4567')->shouldHaveType('CollegeFB\Entities\Game');
    }

    public function it_should_return_a_game_when_trying_to_find_by_game_date_and_teams()
    {
        $this->getByDateAndTeams(time(), 'Test', 'Test')->shouldHaveType('CollegeFB\Entities\Game');
    }

    public function it_should_return_a_list_of_games()
    {
        $this->listAll(1, 0)->shouldHaveType('CollegeFB\Iterators\Game');
    }
}
