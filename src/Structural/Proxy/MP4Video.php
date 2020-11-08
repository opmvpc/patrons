<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Proxy;

class MP4Video implements Video
{
    /**
     * @var string
     */
    private string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return void
     */
    public function play(): void
    {
        // play the video using filename
    }

    /**
     * @return void
     */
    public function show(): void
    {
        // show image from file metadata
    }
}
