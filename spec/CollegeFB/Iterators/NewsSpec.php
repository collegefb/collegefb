<?php

namespace spec\CollegeFB\Iterators;

use PhpSpec\ObjectBehavior;

class NewsSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(array());
    }

    public function it_is_possible_to_add_entities()
    {
        $this->append(array('title' => 'Test'));

        $this->count()->shouldBeEqualTo(1);

        $this->offsetGet(0)->shouldHaveType('CollegeFB\Entities\News');
    }

    public function it_is_possible_to_add_more_than_one_article_at_once()
    {
        $this->addNews(array(
            array('title' => 'Test'),
            array('title' => 'Test2'),
            array('title' => 'Test3'),
        ));

        $this->count()->shouldBeEqualTo(3);

        $this->offsetGet(0)->shouldHaveType('CollegeFB\Entities\News');
    }
}
