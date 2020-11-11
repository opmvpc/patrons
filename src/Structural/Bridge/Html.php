<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Bridge;

class Html implements RendererImplementation
{
    public function header(string $text): string
    {
        return "<html>
        <head>
        <title>".$text."</title>
        </head>
        <body>\n";
    }

    public function footer(): string
    {
        return "</body>
        </html>";
    }

    public function title(string $text): string
    {
        return "<h1>".$text."</h1>\n";
    }

    public function text(string $text): string
    {
        return "<p>".$text."</p>\n";
    }

    public function link(string $url): string
    {
        return "<a href=\"http://".$url."\">".$url."</a>\n";
    }

    public function img(string $url): string
    {
        return "<img href=\"".$url."\">\n";
    }
}
