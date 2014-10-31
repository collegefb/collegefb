<?php

namespace spec\CollegeFB\Entities;

use PhpSpec\ObjectBehavior;

class ConferenceSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('CollegeFB\Entities\Conference');
    }

    public function it_is_initializable_with_data()
    {
        $data = array(
            'name'      => 'Test',
            'division'  => 'Div',
        );
        $this->beConstructedWith($data);

        $this->getName()->shouldBeEqualTo('Test');
        $this->getDivision()->shouldBeEqualTo('Div');
    }

    public function it_should_not_be_possible_to_change_the_url()
    {
        $this->setUrl('test')->getUrl()->shouldBeNull();
    }

    public function it_should_generate_the_url_when_setting_the_name()
    {
        $this->setName('testing')->getUrl()->shouldBeEqualTo('testing');
    }
}
