<?php
namespace GianArb\LeanQueue;

class Message implements MessageInterface
{
    private $content;

    public function setContent($content){
        $this->content = $content;
        return $this;
    }

    public function getContent(){
        return $this->content;
    }
}
