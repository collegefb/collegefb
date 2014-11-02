<?php

namespace spec\CollegeFB\Services\News;

use PhpSpec\ObjectBehavior;
use CollegeFB\Repositories\NewsInterface;
use CollegeFB\Factories\News as NewsFactory;
use CollegeFB\Entities\News as NewsEntity;

class NewNewsSpec extends ObjectBehavior
{
    public function let(NewsInterface $repository, NewsFactory $factory)
    {
        $news_to_save = new NewsEntity();
        $factory->newsEntity(array())->willReturn($news_to_save);

        $news_to_save_that_fails = new NewsEntity();
        $news_to_save_that_fails->setLink('fails');
        $factory->newsEntity(array('link' => 'fails'))->willReturn($news_to_save_that_fails);

        $repository->getByLink(null)->willReturn(false);
        $repository->getByLink('fails')->willReturn(false);
        $repository->save($news_to_save)->willReturnArgument(0);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\News\NewNews');
    }

    public function it_save_an_article_when_does_not_exist()
    {
        $this->run(array())->shouldReturnAnInstanceOf('CollegeFB\Entities\News');
    }

    public function it_fails_when_article_exists()
    {
        $this->shouldThrow('\RuntimeException')->duringRun(array('link' => 'fails'));
    }
}
