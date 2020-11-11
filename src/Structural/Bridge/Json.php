<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Bridge;

class Json implements RendererImplementation
{
    public function header(string $text): string
    {
        return "{\n";
    }

    public function footer(): string
    {
        return "}";
    }

    public function title(string $text): string
    {
        return "title: '".$text."',\n";
    }

    public function text(string $text): string
    {
        return "text: '".$text."',\n";
    }

    public function link(string $url): string
    {
        return "link: {\nhref: '".$url."'\n}\n";
    }

    public function img(string $url): string
    {
        return "img: '".$url."',\n";
        ;
    }
}
