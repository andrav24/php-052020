<?php

namespace App\Controllers;

use App\Models\Post;

class AdminController
{

    public function deleteMessageAction()
    {
        $postId = (int) $_GET['id'];
        Post::deletePost($postId);
        header('Location: /blog');
    }

}