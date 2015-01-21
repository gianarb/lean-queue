<?php

namespace GianArb\LeanQueue;

class Queue implements QueueInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Adapter\AdapterInterfae
     */
    private $adapter;

    /**
     * @var MessageInterface
     */
    private $messageObject;

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

    public function getMessageObject()
    {
        if(!$this->messageObject){
            $this->messageObject = new Message();
        }
        return $this->messageObject;
    }

    public function setMessageObject(MessageInterface $messageObject)
    {
        $this->messageObject = $messageObject;
    }

    public function sendMessage($message)
    {
        if(is_string($message)){
            $messageObj = $this->getMessageObject();
            $messageObj->setContent($message);
        }
        return $this->getAdapter()->sendMessage($messageObj);
    }

    public function receiveMessage()
    {
        return $this->getAdapter()->receiveMessage();
    }
}
