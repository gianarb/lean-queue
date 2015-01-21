<?php

namespace spec\GianArb\LeanQueue;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QueueSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith("queue-name");
    }

    function it_is_initializable()
    {
        $this->shouldImplement('GianArb\LeanQueue\Queue');
    }

    function it_get_adapter(\GianArb\LeanQueue\Adapter\AdapterInterface $adapter)
    {
        $this->setAdapter($adapter);
        $this->getAdapter()->shouldReturn($adapter);
    }

    function it_calls_send_from_adapter(\GianArb\LeanQueue\Adapter\AdapterInterface $adapter)
    {
        $adapter->send("queue-name", "{}")->shouldBeCalled();

        $this->setAdapter($adapter);
        $this->send("{}");
    }

    function it_calls_receive_from_adapter(\GianArb\LeanQueue\Adapter\AdapterInterface $adapter)
    {
        $adapter->receive("queue-name")->shouldBeCalled();

        $this->setAdapter($adapter);
        $this->receive();
    }
}
