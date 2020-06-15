<?php

namespace App\Models;

use Core\Application;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $passwordHash;
    private $dateReg;

    public static function genPasswordHash($password)
    {
        return sha1($password . 'sdlfsjxv');
    }

    public function loadData(array $data, $new = false)
    {
        if (isset($data['id'])) {
            $this->id = $data['id'];
        }
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->dateReg = $data['date_reg'];
        if ($new) {
            $this->passwordHash = self::genPasswordHash($data['password']);
        } else {
            $this->passwordHash = $data['password'];
        }
    }

    public function save()
    {
        $db = Application::getInstance()->getDb();
        $ret = $db->exec(
            "insert into users (`name`, `email`, `password`, date_reg) values (:name, :email, :passw, :datereg)",
            ['name' => $this->name, 'email' => $this->email, 'passw' => $this->passwordHash, 'datereg' => $this->dateReg],
        );
        if (!$ret) {
            return false;
        }
        $this->id = $db->lastInsertId();
        return true;
    }

    public function getByEmailAndPassword(string $email, string $password)
    {
        $db = Application::getInstance()->getDb();
        $data = $db->fetchOne(
            "select * from users where `email` = :email and `password` = :passw",
            ['email' => $email, 'passw' => self::genPasswordHash($password)]);
        if ($data) {
            $this->loadData($data);
            return true;
        }
        return false;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @param string $passwordHash
     */
    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }

    /**
     * @return int
     */
    public function getDateReg(): int
    {
        return $this->dateReg;
    }

    /**
     * @param int $dateReg
     */
    public function setDateReg(int $dateReg): void
    {
        $this->dateReg = $dateReg;
    }
}