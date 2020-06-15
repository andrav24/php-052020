<?php


namespace App\Controllers;


use Core\Controller;

class ErrorController extends Controller
{

    private $errMsg;

    public function __construct()
    {
        if (isset($_SESSION['ErrorController'])) {
            $this->errMsg = $_SESSION['ErrorController'];
            unset($_SESSION['ErrorController']);
        }
    }

    public function indexAction()
    {

        //$this->_render = false;
    }

    public function regAction()
    {
        $this->view->errMsg = $this->errMsg;
    }
}