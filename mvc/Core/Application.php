<?php

namespace Core;

class Application
{
    private static Application $app;
    private Router $router;
    private ControllerManager $controllerManager;

    private function __construct()
    {
        $this->router = new \Core\Router();
        $this->controllerManager = new ControllerManager();
    }

    public static function getInstance(): Application
    {
        if (!isset(self::$app)) {
            self::$app = new Application();
        }
        return self::$app;
    }

    public function run()
    {
        $this->router->dispatch($_SERVER['REQUEST_URI']);
    }

    /**
     * @return Router
     */
    public function getRouter(): Router
    {
        return $this->router;
    }

    /**
     * @return ControllerManager
     */
    public function getControllerManager(): ControllerManager
    {
        return $this->controllerManager;
    }
}