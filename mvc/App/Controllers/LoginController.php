<?php


namespace App\Controllers;


use App\Models\User;
use Core\Controller;

class LoginController extends Controller
{
    public function indexAction()
    {
    }

    public function authAction()
    {
        $data = [];
        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['password'] = $_POST['password'];
        $data['password2'] = $_POST['password2'];
        $data['date_reg'] = date('Y-m-d H:i:s');

        $user = new User();
        $res = $user->getByEmailAndPassword($data['email'], $data['password']);
        if ($res) {
            $_SESSION['auth'] = true;
            header('Location: /blog');
        } else {
            header('Location: /register');
        }
        #$this->view->data = $data;
        return;

    }
}