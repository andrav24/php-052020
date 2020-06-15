<?php

namespace Core;

class Application
{
    private static Application $app;
    private Router $router;
    private ControllerManager $controllerManager;
    private DB $db;

    private function __construct()
    {
        $this->router = new \Core\Router();
        $this->controllerManager = new \Core\ControllerManager();
        $this->db = new \Core\DB();
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
        $router = $this->router;
        $controllerManager = $this->controllerManager;

        $router->dispatch($_SERVER['REQUEST_URI']);
        $controllerManager->setController($this->router->getRoute());
        $controllerName = $this->controllerManager->getController();
        $controllerAction = $this->controllerManager->getAction();
        /** @var Controller $controllerObj */
        $controllerObj = new $controllerName();

        $tpl = "../App/Views/" . $controllerManager->getControllerViewName()
            . "/" . $controllerManager->getActionViewName() . ".phtml";


        $controllerObj->view = new \Core\View();
        $controllerObj->$controllerAction();
        if ($controllerObj->needRender()) {
            $html = $controllerObj->view->render($tpl);
            echo $html;
        }
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

    /**
     * @return DB
     */
    public function getDb(): DB
    {
        return $this->db;
    }


}
