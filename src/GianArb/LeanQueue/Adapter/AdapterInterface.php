<?php
namespace GianArb\LeanQueue\Adapter;

interface AdapterInterface
{
    public function sendMessage($message);
    public function receiveMessage();
}
