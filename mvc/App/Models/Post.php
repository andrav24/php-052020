<?php
namespace App\Models;

use Core\Application;

class Post
{
    private $id;
    private $text;
    private $createdAt;
    private $authorId;
    /** @var User */
    private $author;
    private $image;

    public function __construct(array $data)
    {
        $this->text = $data['text'];
        $this->createdAt = $data['created_at'];
        $this->authorId = $data['author_id'];
        $this->image = $data['image'] ?? '';
    }

    public static function deletePost(int $postId)
    {
        $db = Application::getInstance()->getDb();
        $query = "DELETE FROM posts WHERE id = $postId";
        return $db->exec($query);
    }

    public function save()
    {
        $db = Application::getInstance()->getDb();
        $res = $db->exec(
            'INSERT INTO posts (text, created_at, author_id, image) VALUES (:text, :created_at,:author_id,:image)',
            [
                ':text' => $this->text,
                ':created_at' => $this->createdAt,
                ':author_id' => $this->authorId,
                ':image' => $this->image,
            ]
        );

        return $res;
    }

    public static function getList(int $limit = 10, int $offset = 0): array
    {
        $db = Application::getInstance()->getDb();
        $data = $db->fetchAll(
            "SELECT * fROM posts LIMIT $limit OFFSET $offset");
        if (!$data) {
            return [];
        }

        $messages = [];
        foreach ($data as $elem) {
            $message = new self($elem);
            $message->id = $elem['id'];
            $messages[] = $message;
        }

        return $messages;
    }

    public static function getUserPosts(int $userId, int $limit): array
    {
        $db = Application::getInstance()->getDb();
        $data = $db->fetchAll(
            "SELECT * fROM posts WHERE author_id = $userId LIMIT $limit");
        if (!$data) {
            return [];
        }

        $messages = [];
        foreach ($data as $elem) {
            $message = new self($elem);
            $message->id = $elem['id'];
            $messages[] = $message;
        }

        return $messages;
    }

    public function loadFile(string $file)
    {
        if (file_exists($file)) {
            $this->image = $this->genFileName();
            move_uploaded_file($file,getcwd() . '/images/' . $this->image);
        }
    }

    private function genFileName()
    {
        return sha1(microtime(1) . mt_rand(1, 100000000)) . '.png';
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    public function getData()
    {
        return [
            'id' => $this->id,
            'author_id' => $this->authorId,
            'text' => $this->text,
            'created_at' => $this->createdAt,
            'image' => $this->image
        ];
    }
}