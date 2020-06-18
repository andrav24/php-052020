<?php

namespace App\Controllers;


use App\Models\Post;
use Core\Controller;

class BlogController extends Controller
{
    public function indexAction()
    {
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
        }
        $posts = Post::getList();
        if ($posts) {
            $userIds = array_map(function (Post $post) {
                return $post->getAuthorId();
            }, $posts);
            $users = \App\Models\User::getByIds($userIds);
            array_walk($posts, function (Post $post) use ($users) {
                if (isset($users[$post->getAuthorId()])) {
                    $post->setAuthor($users[$post->getAuthorId()]);
                }
            });
        }

        $this->view->posts = $posts;

    }

    public function addMessageAction()
    {
        if (!isset($_SESSION['auth'])) {
            header('Location: /login');
        }

        $text = (string) $_POST['text'];
        if (!$text) {
            $this->error('Сообщение не может быть пустым');
        }

        $message = new Post([
            'text' => $text,
            'author_id' => $_SESSION['id'],
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if (isset($_FILES['image']['tmp_name'])) {
            $message->loadFile($_FILES['image']['tmp_name']);
        }

        $message->save();
        header('Location: /blog');
    }
}