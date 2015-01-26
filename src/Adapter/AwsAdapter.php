<?php

namespace GianArb\LeanQueue\Adapter;

class AwsAdapter implements AdapterInterface
{
    private $sqsClient;

    public function __construct(\Aws\Sqs\SqsClient $sqsClient)
    {
        $this->sqsClient = $sqsClient;
    }

    public function send($queueName, $message)
    {
        $response = $this->sqsClient->sendMessage([
            "QueueUrl" => $queueName,
            "MessageBody" => $message,
        ]);
        return $response["MessageId"];
    }

    public function receive($queueName)
    {
        $response = $this->sqsClient->receiveMessage([
            "QueueUrl" => $queueName
        ]);

        return [$response["Messages"][0]["ReceiptHandle"], $response["Messages"][0]["Body"]];
    }

    public function delete($receipt, $queueName)
    {
        $response = $this->sqsClient->deleteMessage([
            "QueueUrl" => $queueName,
            "ReceiptHandle" => $receipt,
        ]);

        return true;
    }
}
