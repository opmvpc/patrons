<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Bridge;

interface RendererImplementation
{
    public function header(string $text): string;

    public function footer(): string;

    public function title(string $text): string;

    public function text(string $text): string;

    public function link(string $url): string;

    public function img(string $url): string;
}
