<?php

namespace App\Framework;

class HttpRequest
{
    private string $_url;
    private string $_method;
    private array $_params;
    private Route $_route;

    public function __construct($url = null, $method = null)
    {
        $this->_url = (is_null($url))?$_SERVER['REQUEST_URI']:$url;
        $this->_method = (is_null($method))?$_SERVER['REQUEST_METHOD']:$method;
        $this->_params = array();
    }

    public function getUrl()
    {
        return $this->_url;
    }

    public function getMethod()
    {
        return $this->_method;
    }

    public function getParams(): array
    {
        return $this->_params;
    }

    public function setRoute($route): void
    {
        $this->_route = $route;
    }

    public function bindParam(): void
    {
        switch($this->_method)
        {
            case "GET":
            case "DELETE":
                foreach($this->_route->getParams() as $param)
                {
                    if(isset($_GET[$param]))
                    {
                        $this->_params[] = $_GET[$param];
                    }
                }
                break;
            case "POST":
            case "PUT":
                foreach($this->_route->getParams() as $param)
                {
                    if(isset($_POST[$param]))
                    {
                        $this->_params[] = $_POST[$param];
                    }
                }
        }
    }

    public function getRoute(): Route
    {
        return $this->_route;
    }

    public function getParam(): array
    {
        return $this->_params;
    }

    public function run($config): void
    {
        $this->_route->run($this,$config);
    }
}