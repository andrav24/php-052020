<?php

namespace Core;

class ControllerManager
{
    const ERROR_CONTROLLER = '\App\Controllers\ErrorController';
    const DEFAULT_CONTROLLER = '\App\Controllers\HomeController';
    const DEFAULT_ACTION = 'indexAction';
    const DEFAULT_CONTROLLER_VIEW_NAME = 'Home';
    const DEFAULT_ACTION_VIEW_NAME = 'index';

    private string $controller = '';
    private string $controllerViewName = '';
    private string $action = '';
    private string $actionViewName = '';


    public function setController(array $route): void
    {
        $tmpController = ucfirst(strtolower($route['controller']));
        $tmpAction = strtolower($route['action']);

        if (!$tmpController || !$this->check($tmpController)) {
            $this->controller = self::DEFAULT_CONTROLLER;
            $this->controllerViewName = self::DEFAULT_CONTROLLER_VIEW_NAME;
        } elseif (!class_exists("App\\Controllers\\" . $tmpController . 'Controller')) {
            $this->controller = self::ERROR_CONTROLLER;
        } else {
            $this->controller = "\App\Controllers\\" . $tmpController . 'Controller';
            $this->controllerViewName = $tmpController;
        }

        if (!$tmpAction || !$this->check($tmpAction)) {
            $this->action = self::DEFAULT_ACTION;
            $this->actionViewName = self::DEFAULT_ACTION_VIEW_NAME;
        } else {
            $this->action = $tmpAction . 'Action';
            $this->actionViewName = $tmpAction;
        }
    }

    private function check(string $key)
    {
        return preg_match('/[a-zA-Z0-9]+/', $key);
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getControllerViewName(): string
    {
        return $this->controllerViewName;
    }

    /**
     * @return string
     */
    public function getActionViewName(): string
    {
        return $this->actionViewName;
    }


}
