<?php

namespace spec\GianArb\LeanQueue\Adapter;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AwsAdapterSpec extends ObjectBehavior
{
    function let(\Aws\Sqs\SqsClient $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('GianArb\LeanQueue\Adapter\AwsAdapter');
    }

    function it_implements_adapter_interface()
    {
        $this->shouldImplement('GianArb\LeanQueue\Adapter\AdapterInterface');
    }

    function it_calls_sendMessage_from_sqsClient(\Aws\Sqs\SqsClient $client)
    {
        $client->sendMessage([
            "QueueUrl" => "queue",
            "MessageBody" => "{}",
        ])->shouldBeCalledTimes(1);

        $this->send("queue", "{}");
    }

    function it_calls_receiveMessage_from_sqsClient(\Aws\Sqs\SqsClient $client)
    {
        $client->receiveMessage([
            "QueueUrl" => "queue",
        ])->shouldBeCalledTimes(1);

        $this->receive("queue");
    }

    function it_sends_message_and_return_messageId(\Aws\Sqs\SqsClient $client)
    {
        $client->sendMessage([
            "QueueUrl" => "queue",
            "MessageBody" => "{}",
        ])->willReturn(unserialize(file_get_contents(__DIR__."/../../resources/sendMessage")));

        $this->send("queue", "{}")->shouldBe("d5bc4a49-c0b3-47fc-aca8-42940784b150");
    }

    function it_receive_message_and_return_the_receipt_and_message(\Aws\Sqs\SqsClient $client)
    {
        $responseMock = unserialize(file_get_contents(__DIR__."/../../resources/receiveMessage"));
        $client->receiveMessage([
            "QueueUrl" => "queue",
        ])->willReturn($responseMock);

        $this->receive("queue")->shouldBeArray([$responseMock["Messages"][0]["ReceiptHandle"], $responseMock["Messages"][0]["Body"]]);
    }

    function it_receive_and_handle_an_empty_message(\Aws\Sqs\SqsClient $client)
    {
        $responseMock = unserialize(file_get_contents(__DIR__."/../../resources/receiveMessageEmpty"));
        $client->receiveMessage([
            "QueueUrl" => "queue",
        ])->willReturn($responseMock);

        $this->receive("queue")->shouldBeArray([null, null]);
    }

    function it_deleteMessage_and_return_true_how_success(\Aws\Sqs\SqsClient $client)
    {
        $responseMock = unserialize(file_get_contents(__DIR__."/../../resources/deleteMessage"));
        $client->deleteMessage([
            "QueueUrl" => "queue",
            "ReceiptHandle" => "sehrh"
        ])->willReturn($responseMock);

        $this->delete("sehrh", "queue")->shouldBe(true);
    }

}
