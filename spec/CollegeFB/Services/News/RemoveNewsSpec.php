<?php

namespace spec\CollegeFB\Services\News;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use CollegeFB\Repositories\NewsInterface;
use CollegeFB\Factories\News as NewsFactory;
use CollegeFB\Entities\News as NewsEntity;

class RemoveNewsSpec extends ObjectBehavior
{
    public function let(NewsInterface $repository, NewsFactory $factory)
    {
        $repository->getById(null)->willReturn(new NewsEntity());
        $repository->getById('non_existing')->willReturn(false);
        $repository->remove(Argument::any())->willReturn(true);

        $this->beConstructedWith($repository, $factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Services\News\RemoveNews');
    }

    public function it_is_possible_to_remove_an_existing_conference()
    {
        $this->run(array('news_id' => null))->shouldBe(true);
    }

    public function it_fails_when_trying_to_remove_non_existing_conference()
    {
        $this->shouldThrow('\RuntimeException')->duringRun(array('news_id' => 'non_existing'));
    }
}
