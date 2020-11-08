<?php

namespace Opmvpc\Patrons\Tests\Structure\Proxy;

use Opmvpc\Patrons\Structural\Proxy\FakeVideo;
use Opmvpc\Patrons\Structural\Proxy\MP4Video;
use PHPUnit\Framework\TestCase;

class ProxyTest extends TestCase
{
    /** @test */
    public function returns_a_new_instance()
    {
        $video = new FakeVideo('path/to/file');
        $this->assertInstanceOf(FakeVideo::class, $video);
    }

    /** @test */
    public function it_creates_a_new_MP4Video()
    {
        $video = new FakeVideo('path/to/file');
        $this->assertNull($video->getRef());
        $video->play();
        $this->assertInstanceOf(MP4Video::class, $video->getRef());
    }

    /** @test */
    public function it_can_show_an_image_placeholder()
    {
        $video = new FakeVideo('path/to/file');
        $this->assertNull($video->getRef());
        $video->show();
    }

    /** @test */
    public function it_can_show_the_video_image()
    {
        $video = new FakeVideo('path/to/file');
        $this->assertNull($video->getRef());
        $video->play();
        $this->assertInstanceOf(MP4Video::class, $video->getRef());
        $video->show();
    }
}
