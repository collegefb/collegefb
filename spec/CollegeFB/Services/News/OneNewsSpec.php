<?php

namespace spec\CollegeFB\Services\News;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use CollegeFB\Repositories\NewsInterface;
use CollegeFB\Factories\News as NewsFactory;
use CollegeFB\Entities\News as NewsEntity;

class OneNewsSpec extends ObjectBehavior
{
    public function let(NewsInterface $repository, NewsFactory $factory)
    {
        $news = new NewsEntity();
        $repository->getById(Argument::any())->willReturn($news);
        $repository->getByLink(Argument::any())->willReturn($news);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\News\OneNews');
    }

    public function it_get_one_article_given_its_id()
    {
        $this->run(array('news_id' => 1))->shouldReturnAnInstanceOf('CollegeFB\Entities\News');
    }

    public function it_get_one_article_given_its_url()
    {
        $this->run(array('news_url' => 1))->shouldReturnAnInstanceOf('CollegeFB\Entities\News');
    }

    public function it_return_null_when_no_article_id_neither_url_is_given()
    {
        $this->run(array())->shouldBe(null);
    }
}
