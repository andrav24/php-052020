<?php


namespace App\Controllers;


use App\Models\Post;
use Core\Controller;

class ApiController extends Controller
{


    public function getUserMessagesAction()
    {
        $this->_render = false;

        $userId = (int) $_GET['user_id'] ?? 0;
        if (!$userId) {
            return $this->response(['error' => 'no_user_id']);
        }
        $messages = Post::getUserPosts($userId, 20);
        if (!$messages) {
            return $this->response(['error' => 'no_messages']);
        }

        $data = array_map(function (Post $message) {
            return $message->getData();
        }, $messages);

        return $this->response(['messages' => $data]);
    }

    public function response(array $data)
    {
        header('Content-type: application/json');
        echo json_encode($data);
    }
}