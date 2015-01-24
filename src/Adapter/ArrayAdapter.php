<?php
namespace GianArb\LeanQueue\Adapter;

use OutOfBoundsException;
use InvalidArgumentException;

class ArrayAdapter implements AdapterInterface
{
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

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

    public function receive($queue)
    {
        if (!array_key_exists($queue, $this->data)) {
            throw new OutOfBoundsException("Missing data");
        }

        $values = array_values($this->data[$queue]);

        $message = [$values[0]["id"], $values[0]["content"]];
        $this->data[$queue][] = ["id" => $values[0]["id"], "content" => $values[0]["content"]];
        array_shift($this->data[$queue]);

        return $message;
    }

    public function delete($receipt, $queue)
    {
        if (array_key_exists($queue, $this->data)) {
            foreach ($this->data[$queue] as $index => $data) {
                if ($this->data[$queue][$index]["id"] == $receipt) {
                    unset($this->data[$queue][$index]);
                    return true;
                }
            }
        }

        throw new InvalidArgumentException("Missing message with receipt: {$receipt}");
    }

    public function getData()
    {
        return $this->data;
    }
}
