<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Bridge;

class Response extends Renderer
{
    const HTML = 'html';
    const JSON = 'json';

    public function __construct(array $data, string $type)
    {
        $this->data = $data;
        $this->renderImplementation = new Html();
        if ($type === static::JSON) {
            $this->renderImplementation = new Json();
        } else {
        }
    }
}
