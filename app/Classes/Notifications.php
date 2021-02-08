<?php

namespace App\Classes;

class Notifications
{
    private $firebase;

    /**
     * Notifications constructor.
     *
     * @param App\Classes\Firebase $firebase
     */
    public function __construct(Firebase $firebase)
    {
        $this->firebase = $firebase;
    }

    /**
     * @param string $channel
     * @param string $content
     */
    public function sendMessageToGroup(string $channel, string $content)
    {
        return $this->firebase->pushNotification($channel, $content);
    }

}
