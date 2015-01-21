<?php
namespace GianArb\LeanQueue\Adapter;

use GianArb\LeanQueue\QueueInterface;

interface AdapterInterface
{
    /**
     * Send message
     * @param string $message
     * @param string $queueName
     * @return boolean
     */
    public function send($queueName, $message);

    /**
     * Receive one message from queue
     * @return list
     */
    public function receive($queueName);
}
