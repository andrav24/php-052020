<?php

namespace Core;

use PDO;

class DB
{
    private PDO $_pdo;
    private array $_log = [];

    private function getConnection()
    {
        if (!isset($this->_pdo)) {
            $this->_pdo = new PDO('mysql:host=localhost;dbname=db_posts', 'user1', 'user1');
        }
        return $this->_pdo;
    }

    function fetchAll(string $query, array $params = [])
    {
        $t = microtime(1);
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);

        $ret = $prepared->execute($params);
        if (!$ret) {
            $errorInfo = $prepared->errorInfo();
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2]);
            return [];
        }

        $data = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $prepared->rowCount();
        $this->_log[] = [$query, microtime(1) - $t, $affectedRows];
        return $data;
    }

    function fetchOne(string $query, array $params = [])
    {
        $t = microtime(1);
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);

        $ret = $prepared->execute($params);
        if (!$ret) {
            $errorInfo = $prepared->errorInfo();
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2]);
            return [];
        }

        $data = $prepared->fetchAll(\PDO::FETCH_ASSOC);
        $affectedRows = $prepared->rowCount();
        $this->_log[] = [$query, microtime(1) - $t, $affectedRows];
        if (!$data) {
            return false;
        }
        return reset($data);
    }

    function exec(string $query, array $params = [])
    {
        $t = microtime(1);
        $pdo = $this->getConnection();
        $prepared = $pdo->prepare($query);

        $ret = $prepared->execute($params);
        if (!$ret) {
            $errorInfo = $prepared->errorInfo();
            trigger_error("{$errorInfo[0]}#{$errorInfo[1]}: " . $errorInfo[2]);
            return -1;
        }
        $affectedRows = $prepared->rowCount();
        $this->_log[] = [$query, microtime(1) - $t, $affectedRows];
        return true;
    }

    function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }
}