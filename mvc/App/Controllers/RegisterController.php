<?php


namespace App\Controllers;


use App\Models\User;
use Core\Controller;

class RegisterController extends Controller
{
    public function indexAction()
    {

    }

    public function regAction()
    {
        $data = [];
        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['password'] = $_POST['password'];
        $data['password2'] = $_POST['password2'];
        $data['date_reg'] = date('Y-m-d H:i:s');

        if (!$this->checkData($data)) {
            $_SESSION['regErr'] = 'Email or password incorrect.';
            header('Location: /register');
            return;
        }
        $user = new User();
        $res = $user->getByEmailAndPassword($data['email'], $data['password']);
        if (!$res) {
            $user->loadData($data, true);
            $user->save($data);
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $user->getId();
            $_SESSION['admin'] = in_array($user->getId(), ADMIN_IDS);
            header('Location: /blog');
        } else {
            $user->loadData($data);
            $_SESSION['regErr'] = 'this email address is already registered.';
            header('Location: /register');
        }
        #$this->view->data = $data;
        return;
    }

    private function checkData(array $data): bool
    {
        if (empty($data['email'])) {
            return false;
        }

        if (empty($data['password']) and empty($data['password2'])) {
            return false;
        }

        if ($data['password'] !== $data['password2']) {
            return false;
        }

        if (strlen($data['password']) < 5) {
            return false;
        }
        return true;
    }
}