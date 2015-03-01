# LeanQueue
Master:
[![Build Status](https://travis-ci.org/gianarb/lean-queue.svg?branch=master)](https://travis-ci.org/gianarb/lean-queue)
Develop:
[![Build Status](https://travis-ci.org/gianarb/lean-queue.svg?branch=develop)](https://travis-ci.org/gianarb/lean-queue)

[![Dependency Status](https://www.versioneye.com/user/projects/54f36da64f3108d1fa0008da/badge.svg?style=flat)](https://www.versioneye.com/user/projects/54f36da64f3108d1fa0008da) [![Code Climate](https://codeclimate.com/github/gianarb/lean-queue/badges/gpa.svg)](https://codeclimate.com/github/gianarb/lean-queue)

lean queue system, receive and send messages for different queue adapters.

For now supports `ArrayAdapter` and `AwsSqs`

## Send messages in queue

```php
<?php

$client = \Aws\Sqs\SqsClient::factory();

$queue = new \GianArb\LeanQueue\Queue("https://sqs.eu-west-1.amazonaws.com/xxxxxx/test-php");
$queue->setAdapter(new \GianArb\LeanQueue\Adapter\AwsAdapter($client));

$queue->send("{'example': '2121'}");
```

## Receive and Delete messages

```php
<?php
$queue = new \GianArb\LeanQueue\Queue("https://sqs.eu-west-1.amazonaws.com/xxxxx/test-php");
$queue->setAdapter(new \GianArb\LeanQueue\Adapter\AwsAdapter($client));

list($receipt, $message) = $queue->receive();

$queue->delete($receipt);
```

## Install

```bash
php composer.phar require "gianarb\lean-queue"
```

## Contribute
Try it and open issues or pull requests! ;)

```shell
vendor/bin/phpspec run
```
