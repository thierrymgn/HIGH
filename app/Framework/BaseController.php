<?php

namespace App\Framework;

use App\Framework\Exceptions\ViewNotFoundException;

enum ControllerType
{
    case VIEW;
    case ACTION;
}

abstract class BaseController
{
    private array $_params;
    private ControllerType $_type;
    protected bool $_show_header = true;

    /**
     * @throws ViewNotFoundException
     */
    public function view(string $filename): void
    {
        if ($this->_type == ControllerType::ACTION && file_exists(__DIR__ . "/../Action/" . $filename . ".php")) {
            extract($this->_params);
            $params = $this->_params;
            include(__DIR__ . "/../Action/" . $filename . ".php");
        } else if ($this->_type == ControllerType::VIEW && file_exists(__DIR__ . "/../View/" . $filename . ".php")) {
            ob_start();
            extract($this->_params);
            $title = $this->getTitle();
            $params = $this->_params;
            $show_header = $this->_show_header;
            include(__DIR__ . "/../View/" . $filename . ".php");
            $content = ob_get_clean();
            include(__DIR__ . "/../View/layout.php");
        } else {
            throw new ViewNotFoundException($filename);
        }
    }

    protected function getTitle(): string
    {
        throw new \Exception("getTitle() must be implemented");
    }

    public function setParams($params): void
    {
        $this->_params = $params;
    }

    public function setControllerType(ControllerType $type): void
    {
        $this->_type = $type;
    }
}
