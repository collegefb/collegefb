<?php

namespace spec\CollegeFB\Services\News;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use CollegeFB\Repositories\NewsInterface;
use CollegeFB\Factories\News as NewsFactory;
use CollegeFB\Entities\News as NewsEntity;

class UpdateNewsSpec extends ObjectBehavior
{
    public function let(NewsInterface $repository, NewsFactory $factory)
    {
        $article_to_save = new NewsEntity();
        $factory->newsEntity(array())->willReturn($article_to_save);

        $non_existing_article = new NewsEntity();
        $non_existing_article->setId('non_existing');
        $factory->newsEntity(array('name' => 'fails'))->willReturn($non_existing_article);

        $repository->getById(null)->willReturn(true);
        $repository->getById('non_existing')->willReturn(false);
        $repository->save(Argument::any())->willReturnArgument(0);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\News\UpdateNews');
    }

    public function it_should_save_existing_article()
    {
        $this->run(array())->shouldReturnAnInstanceOf('CollegeFB\Entities\News');
    }

    public function it_should_fail_when_trying_to_save_a_non_existing_article()
    {
        $this->shouldThrow('\RuntimeException')->duringRun(array('name' => 'fails'));
    }
}
