<?php

namespace spec\GianArb\LeanQueue\Adapter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ArrayAdapterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GianArb\LeanQueue\Adapter\ArrayAdapter');
    }

    function it_implements_adapter_interface()
    {
        $this->shouldImplement('GianArb\LeanQueue\Adapter\AdapterInterface');
    }

    function it_sends_message()
    {
        $this->send("test", "{}")->shouldBeInteger();
        $this->getData()->shouldHaveCount(1);
    }
}
