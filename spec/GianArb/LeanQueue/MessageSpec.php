<?php

namespace spec\GianArb\LeanQueue;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GianArb\LeanQueue\Message');
    }
}
