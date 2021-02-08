<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;

class Firebase
{
    /**
     * @param string $channel
     * @param string $content
     */
    public function pushNotification(string $channel, string $content)
    {
        $response = Http::get("https://jsonplaceholder.typicode.com/$channel/$content");

        return $response->json();
    }

}
