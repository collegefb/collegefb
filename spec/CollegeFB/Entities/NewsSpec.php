<?php

namespace spec\CollegeFB\Entities;

use PhpSpec\ObjectBehavior;

class NewsSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Entities\News');
    }

    public function it_is_initializable_with_data()
    {
        $data = array(
            'title' => 'Test',
            'link'  => 'http://test.url',
        );
        $this->beConstructedWith($data);

        $this->getTitle()->shouldBeEqualTo('Test');
        $this->getLink()->shouldBeEqualTo('http://test.url');
    }
}
