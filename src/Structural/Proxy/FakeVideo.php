<?php

declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Proxy;

class FakeVideo implements Video
{
    /**
     * @var string
     */
    private string $fileName;

    /**
     * @var null|Video
     */
    private ?Video $ref = null;

    /**
     * @param string $filename
     * @return void
     */
    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return void
     */
    public function play(): void
    {
        if ($this->ref === null) {
            $this->ref = new MP4Video($this->fileName);
        }
        $this->ref->play();
    }

    /**
     * @return void
     */
    public function show(): void
    {
        if ($this->ref === null) {
            $this->drawImage();
        } else {
            $this->ref->show();
        }
    }

    /**
     * @return void
     */
    private function drawImage(): void
    {
        // draw img from first frame of the video
    }

    /**
     *
     * @return null|Video
     */
    public function getRef(): ?Video
    {
        return $this->ref;
    }
}
