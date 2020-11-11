<?php


declare(strict_types=1);

namespace Opmvpc\Patrons\Structural\Bridge;

abstract class Renderer
{
    /**
     *
     * @var RendererImplementation
     */
    protected RendererImplementation $renderImplementation;

    /**
     *
     * @var array
     */
    protected array $data;

    public function setImplementation(RendererImplementation $renderImplementation): void
    {
        $this->renderImplementation = $renderImplementation;
    }

    public function render(): string
    {
        $code = $this->renderImplementation->header($this->data['title']);
        $code .= $this->renderImplementation->title($this->data['title']);
        $code .= $this->renderImplementation->img($this->data['img']);
        $code .= $this->renderImplementation->text($this->data['text']);
        $code .= $this->renderImplementation->link($this->data['link']);
        $code .= $this->renderImplementation->footer();

        return $code;
    }
}
