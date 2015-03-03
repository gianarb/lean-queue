# Symfony DiC integration
This is a small example of integration between LeanQueue and Symfony DiC.  

## Production with Aws SQS
```yml
services:
    aws.sqs.client:
    factory_class: Aws\Sqs\SqsClient
    class: Aws\Sqs\SqsClient
    factory_method: factory
    arguments:
        - {key:"%aws.key%", secret:"%aws.secret%", region:"%aws.region%"}

    queue.adapter:
        class: GianArb\LeanQueue\Adapter\AwsAdapter
        arguments:
            - "@aws.sqs.client"

    my.queue:
        class: GianArb\LeanQueue\Queue
        arguments:
            - "%queue.ebay.name%"
        calls:
            - ["setAdapter", ["@queue.product.adapter"]]
```
You can use a container to resume your queue `$this->get("my.queue")`.

## Tests
Durin tests you can not use an AWS queue, with **LeanQueue** you can replace
the `AwsAdapter` with `ArrayAdapter` and you can run it in your tests

```yml
services:
    queue.adapter:
        class: GianArb\LeanQueue\Adapter\ArrayAdapter
```
