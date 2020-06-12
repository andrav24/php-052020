<?php

namespace Core;

class Router
{

    public function __construct()
    {

    }

    public function addRoute(string $route, array $params = [])
    {

    }

    public function dispatch(string $routeURI): string
    {

        $parts = explode('/', $routeURI);
        $controllerName = $parts[1] ?? '';
        $actionName = $parts[2] ?? '';

        if (!$controllerName || !$this->check($controllerName)) {
            $this->_controllerName = self::DEFAULT_CONTROLLER;
        } else {
            $this->_controllerName = ucfirst(strtolower($controllerName));
        }

        if (!$actionName || !$this->check($actionName)) {
            $this->_actionToken = self::DEFAULT_ACTION;
        } else {
            $this->_actionToken = strtolower($actionName);
        }

        return '';
    }

    private function check(string $key)
    {
        return preg_match('/[a-zA-Z0-9]+/', $key);
    }
}