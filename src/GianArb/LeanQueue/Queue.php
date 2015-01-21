<?php

namespace GianArb\LeanQueue;

class Queue
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Adapter\AdapterInterfae
     */
    private $adapter;

    public function __construct($queueName)
    {
        $this->setName($queueName);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function setAdapter(Adapter\AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    public function send($message)
    {
        return $this->getAdapter()->send($this->getName(), $message);
    }

    public function receive()
    {
        return $this->getAdapter()->receive($this->getName());
    }

}
