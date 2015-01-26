<?php
namespace spec\GianArb\LeanQueue\Adapter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ArrayAdapterSpec extends ObjectBehavior
{
    function let() {
        $this->beConstructedWith([
            "queue-name" => [
                ["id" => 123456, "content" => "{'content': true}"],
                ["id" => 123457, "content" => "{'content': false}"],
            ],
        ]);
    }
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
        $this->getData()->shouldHaveCount(2);
        $this->getData()["test"]->shouldHaveCount(1);
    }

    function it_should_reply_with_a_message()
    {
        $this->getData()["queue-name"]->shouldHaveCount(2);
        $this->receive("queue-name")->shouldBe([123456, "{'content': true}"]);
        $this->getData()["queue-name"]->shouldHaveCount(2);
    }

    function it_should_move_messages_around_the_queue()
    {
        $this->receive("queue-name")->shouldBe([123456, "{'content': true}"]);
        $this->receive("queue-name")->shouldBe([123457, "{'content': false}"]);
        $this->receive("queue-name")->shouldBe([123456, "{'content': true}"]);
        $this->receive("queue-name")->shouldBe([123457, "{'content': false}"]);
        $this->getData()["queue-name"]->shouldHaveCount(2);
    }

    function it_should_delete_an_existing_message()
    {
        $this->delete(123456, "queue-name")->shouldBe(true);
        $this->getData()["queue-name"]->shouldHaveCount(1);
    }

    function it_should_notify_that_the_queue_doesnt_exists()
    {
        $this->receive("test")->shouldBe([null, null]);
    }

    function it_should_notify_that_the_queue_is_empty()
    {
        $this->beConstructedWith([
            "queue-name" => []
        ]);

        $this->receive("queue-name")->shouldBe([null, null]);
    }

    function it_should_notify_that_the_message_is_not_deleted()
    {
        $this->shouldThrow("InvalidArgumentException")->during("delete", ["missing-receipt", "queue-name"]);
    }
}
