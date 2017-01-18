<?php

namespace Tests\Container\Stupids;

class StupidClass
{
    private $mailer;

    public function __construct(Maille $mailer)
    {
        $this->mailer = $mailer;
    }
}
