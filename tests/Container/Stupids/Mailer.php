<?php

namespace Tests\Container\Stupids;

class Mailer
{
    public function mail($recipient, $content)
    {
        return $recipient . ': ' . $content;
    }
}
