<?php

namespace App\Framework;

class Route
{
    public function __construct(
        private readonly string $name,
        private readonly string $path,
        private readonly string $controller,
        private readonly string $method,
        private readonly string|null $action = null,
        private readonly string|null $view = null,
        private readonly array  $params = [],
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getController(): BaseController
    {
        $controller = new ('\\App\\Controller\\' . $this->controller . 'Controller')();
        $controller->setParams($this->params);
        $controller->setControllerType($this->action ? ControllerType::ACTION : ControllerType::VIEW);
        return $controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getView(): string
    {
        return $this->view;
    }

    public function getActionOrView(): string
    {
        return $this->action ?? $this->view;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}
