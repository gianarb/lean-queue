<?php
namespace GianArb\LeanQueue;

interface QueueInterface
{
    /**
     * Get queue name
     * @return string
     */
    public function getName();

    /**
     * Set queue name
     * @param string $name
     * @return this
     */
    public function setName($name);

    /**
     * Return queue adapter
     * @return Adapter\AdapterInterface
     */
    public function getAdapter();

    /**
     * Set queue adapter
     * @param Adapter\AdapterInterface $adapter
     * @return this
     */
    public function setAdapter(Adapter\AdapterInterface $adapter);

    /**
     * Get message object
     * @return MessageInterface
     */
    public function getMessageObject();

    /**
     * Set type of message
     * @param MessageInterface $messageObject
     * @return this
     */
    public function setMessageObject(MessageInterface $messageObject);

    /**
     * Send message in queue
     * @param string|MessageInterface $message
     * @return boolean
     */
    public function sendMessage($message);

    /**
     * Receive message from queue
     * return MessageInterface
     */
    public function receiveMessage();
}
