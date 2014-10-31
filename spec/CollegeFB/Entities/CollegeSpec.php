<?php

namespace spec\CollegeFB\Entities;

use PhpSpec\ObjectBehavior;

class CollegeSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Entities\College');
    }

    public function it_is_initializable_with_data()
    {
        $data = array(
            'name'  => 'Test',
            'city'  => 'Spec City',
        );
        $this->beConstructedWith($data);

        $this->getName()->shouldBeEqualTo('Test');
        $this->getCity()->shouldBeEqualTo('Spec City');
    }

    public function it_should_not_be_possible_to_change_the_url()
    {
        $this->setUrl('test')->getUrl()->shouldBeNull();
    }

    public function it_should_generate_the_url_when_setting_the_name()
    {
        $this->setName('testing')->getUrl()->shouldBeEqualTo('testing');
    }

    public function it_should_generate_the_url_when_setting_the_nickname()
    {
        $this->setNickname('nickname_test')->getUrl()->shouldBeEqualTo('nickname-test');
    }
}
