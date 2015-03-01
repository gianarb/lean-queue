## Getting Started
Send message in a SNS queue
```php
<?php

$client = \Aws\Sqs\SqsClient::factory();

$queue = new \GianArb\LeanQueue\Queue("https://sqs.eu-west-1.amazonaws.com/xxxxxx/test-php");
$queue->setAdapter(new \GianArb\LeanQueue\Adapter\AwsAdapter($client));

$queue->send("{'example': '2121'}");
```

Receive and delete it
```php
<?php
$queue = new \GianArb\LeanQueue\Queue("https://sqs.eu-west-1.amazonaws.com/xxxxx/test-php");
$queue->setAdapter(new \GianArb\LeanQueue\Adapter\AwsAdapter($client));

list($receipt, $message) = $queue->receive();

$queue->delete($receipt);
```
