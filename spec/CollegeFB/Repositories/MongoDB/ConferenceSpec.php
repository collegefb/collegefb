<?php

namespace spec\CollegeFB\Repositories\MongoDB;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use MongoDB;
use MongoCollection;
use MongoCursor;
use ArrayIterator;
use CollegeFB\Entities\Conference as ConferenceEntity;

class ConferenceSpec extends ObjectBehavior
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

        $mongo_db->selectCollection('conferences')->willReturn($mongo_collection);

        $this->beConstructedWith($mongo_db);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Repositories\MongoDB\Conference');
    }

    public function it_should_save_a_conference_when_given()
    {
        $college = new ConferenceEntity();

        $this->save($college)->shouldBeEqualTo($college);
    }

    public function it_should_be_possible_to_remove_given_conference()
    {
        $college = new ConferenceEntity();
        $college->setId(1);

        $this->remove($college)->shouldBe(true);
    }

    public function it_should_return_a_conference_when_trying_to_find_by_name()
    {
        $this->getByName('test')->shouldHaveType('CollegeFB\Entities\Conference');
    }

    public function it_should_return_a_conference_when_trying_to_find_by_id()
    {
        $this->getById('5443c7dcc863c7a90f8b4567')->shouldHaveType('CollegeFB\Entities\Conference');
    }

    public function it_should_return_a_conference_when_trying_to_find_by_url()
    {
        $this->getByUrl('test')->shouldHaveType('CollegeFB\Entities\Conference');
    }

    public function it_should_return_a_list_of_conferences()
    {
        $this->listAll(1, 0)->shouldHaveType('CollegeFB\Iterators\Conference');
    }
}
