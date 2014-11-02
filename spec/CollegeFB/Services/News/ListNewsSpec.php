<?php

namespace spec\CollegeFB\Services\News;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use CollegeFB\Repositories\NewsInterface;
use CollegeFB\Factories\News as NewsFactory;
use CollegeFB\Iterators\News as NewsIterator;

class ListNewsSpec extends ObjectBehavior
{
    public function let(NewsInterface $repository, NewsFactory $factory)
    {
        $repository->listAll(0, 25)->willReturn(new NewsIterator(array(1, 2)));
        $repository->setQueryParams(Argument::any(), Argument::any())->willReturn(true);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\News\ListNews');
    }

    public function it_should_return_the_latest_news_without_origin()
    {
        $this->run(array())->shouldReturnAnInstanceOf('CollegeFB\Iterators\News');
    }

    public function it_should_return_the_latest_news_with_origin()
    {
        $this->run(array('origin_id' => 1))->shouldReturnAnInstanceOf('CollegeFB\Iterators\News');
        $this->run(array('origin' => 1))->shouldReturnAnInstanceOf('CollegeFB\Iterators\News');
    }
}
