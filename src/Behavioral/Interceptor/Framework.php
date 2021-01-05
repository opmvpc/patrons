<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Behavioral\Interceptor;

class Framework
{
    private Request $request;

    public function __construct()
    {
        $this->request = new Request($_GET);
    }
}
