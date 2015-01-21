# LeanQueue
lean queue system, receive and send messages in different service.

Now support `ArrayAdapter` for testing and `AwsSqs`

```php
<?php

$client = \Aws\Sqs\SqsClient::factory();

$queue = new \GianArb\LeanQueue\Queue("https://sqs.eu-west-1.amazonaws.com/xxxxxx/test-php");
$queue->setAdapter(new \GianArb\LeanQueue\Adapter\AwsAdapter($client));
$queue->send("{'example': '2121'}");
```
## Receive and Delete message
```php
<?php
$queue = new \GianArb\LeanQueue\Queue("https://sqs.eu-west-1.amazonaws.com/xxxxx/test-php");
$queue->setAdapter(new \GianArb\LeanQueue\Adapter\AwsAdapter($client));
list($message, $receipt) = $queue->receive();

$queue->deleteMessage($receipt);
```

## Install
```bash
php composer.phar require "gianarb\lean-queue"
```

## Contribution
Try it, you send my your feedback and help me with PRs.
```shell
vendor/bin/phpspec run
```
