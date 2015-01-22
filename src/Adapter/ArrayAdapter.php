<?php

namespace GianArb\LeanQueue\Adapter;

class ArrayAdapter implements AdapterInterface
{
    private $data = [];

    public function send($queue, $message)
    {
        if (!array_key_exists($queue, $this->data)) {
            $this->data[$queue] = [];
        }

        $d = array(
            'id' => rand(1e6, 10e6),
            'content'    => $message,
        );

        $this->data[$queue][] = $d;
        return $d['id'];
    }

    public function deleteMessage($receipt, $queue)
    {
    }

    public function receive($queue)
    {
        if (!array_key_exists($queue, $this->data)) {
            throw \Exception();
        }
        $row = $this->data[$queue->getName()][0];
        return [$row['id'], $row['content']];
    }

    public function getData()
    {
        return $this->data;
    }
}
