<?php

namespace Opmvpc\Patrons\Tests\Structural\Bridge;

use Opmvpc\Patrons\Structural\Bridge\Json;
use Opmvpc\Patrons\Structural\Bridge\Response;
use PHPUnit\Framework\TestCase;

class RendererTest extends TestCase
{
    /** @test */
    public function it_can_render_in_html()
    {
        $renderer = new Response($this->getTestData(), Response::HTML);
        $this->assertEquals($this->getExpextedHmtl(), $renderer->render());
    }

    /** @test */
    public function it_can_render_in_json()
    {
        $renderer = new Response($this->getTestData(), Response::JSON);
        $this->assertEquals($this->getExpextedJson(), $renderer->render());
    }

    /** @test */
    public function set_implementation()
    {
        $renderer = new Response($this->getTestData(), Response::HTML);
        $renderer->setImplementation(new Json());
        $this->assertEquals($this->getExpextedJson(), $renderer->render());
    }

    public function getTestData(): array
    {
        return [
            'title' => 'coucou',
            'img' => 'coucou.jpg',
            'text' => 'salut',
            'link' => 'coucou.com',
        ];
    }

    public function getExpextedHmtl(): string
    {
        return <<<EOT
<html>
        <head>
        <title>coucou</title>
        </head>
        <body>
<h1>coucou</h1>
<img href="coucou.jpg">
<p>salut</p>
<a href="http://coucou.com">coucou.com</a>
</body>
        </html>
EOT;
    }

    public function getExpextedJson(): string
    {
        return <<<EOT
{
title: 'coucou',
img: 'coucou.jpg',
text: 'salut',
link: {
href: 'coucou.com'
}
}
EOT;
    }
}
