<?php

namespace spec\CollegeFB\Repositories\MongoDB;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use MongoDB;
use MongoCollection;
use MongoCursor;
use ArrayIterator;
use CollegeFB\Entities\College as CollegeEntity;

class CollegeSpec extends ObjectBehavior
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

        $mongo_db->selectCollection('colleges')->willReturn($mongo_collection);

        $this->beConstructedWith($mongo_db);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Repositories\MongoDB\College');
    }

    public function it_should_save_a_college_when_given()
    {
        $college = new CollegeEntity();

        $this->save($college)->shouldBeEqualTo($college);
    }

    public function it_should_be_possible_to_remove_given_college()
    {
        $college = new CollegeEntity();
        $college->setId('54312fd4c863c796148b458b');

        $this->remove($college)->shouldBe(true);
    }

    public function it_should_return_a_college_when_trying_to_find_by_name()
    {
        $this->getByName('test')->shouldHaveType('CollegeFB\Entities\College');
    }

    public function it_should_return_a_college_when_trying_to_find_by_id()
    {
        $this->getById('5443c7dcc863c7a90f8b4567')->shouldHaveType('CollegeFB\Entities\College');
    }

    public function it_should_return_a_college_when_trying_to_find_by_url()
    {
        $this->getByUrl('test')->shouldHaveType('CollegeFB\Entities\College');
    }

    public function it_should_return_a_list_of_colleges()
    {
        $this->listAll(1, 0)->shouldHaveType('CollegeFB\Iterators\College');
    }
}
