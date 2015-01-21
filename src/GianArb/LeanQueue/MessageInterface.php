<?php
namespace GianArb\LeanQueue;

interface MessageInterface
{
    /**
     * Set message content
     * @param string $message
     * @return $this
     */
    public function setContent($message);

    /**
     * Get content
     * @return string
     */
    public function getContent();
}
