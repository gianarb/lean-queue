<?php

namespace spec\GianArb\LeanQueue;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QueueSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GianArb\LeanQueue\Queue');
    }

    function it_implements_queue_interface()
    {
        $this->shouldHaveType('GianArb\LeanQueue\QueueInterface');
    }

    function it_get_adapter(\GianArb\LeanQueue\Adapter\AdapterInterface $adapter)
    {
        $this->setAdapter($adapter);
        $this->getAdapter()->shouldReturn($adapter);
    }

    function it_calls_sendMessage_from_adapter(\GianArb\LeanQueue\Adapter\AdapterInterface $adapter)
    {
        $messageObject = new \GianArb\LeanQueue\Message();
        $messageObject->setContent("string");

        $adapter->sendMessage($messageObject)->shouldBeCalled();
        $this->setAdapter($adapter);
        $this->sendMessage("string");
    }
}
