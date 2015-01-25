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
        if ($this->missingOrEmptyQueue($queue)) {
            return [null, null];
        }

        $value = array_shift($this->data[$queue]);

        $message = [$value["id"], $value["content"]];
        $this->data[$queue][] = ["id" => $value["id"], "content" => $value["content"]];

        return $message;
    }

    private function missingOrEmptyQueue($queue)
    {
        if (!array_key_exists($queue, $this->data)) {
            return true;
        }

        return false;
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
