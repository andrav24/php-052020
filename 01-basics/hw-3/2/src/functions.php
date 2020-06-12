<?php

declare(strict_types=1);
require_once 'config.php';

function checkOrder(array $order)
{
    return !empty($order['email']);
}

function getClientByEmail(PDO $pdo, string $email)
{
    $query = "SELECT * FROM clients where trim(email) = :email";
    $st = $pdo->prepare($query);
    $res = $st->execute(['email' => $email]);
    if (!$res) {
        print_r($pdo->errorInfo());
        die;
    }
    return $st->fetch(PDO::FETCH_ASSOC);
}

function connectToSql()
{
    $host = DB_HOST;
    $dbName = DB_NAME;
    $dbUser = DB_USER;
    $dbPassword = DB_PASSWORD;

    try {
        return new PDO("mysql:host=$host;dbname=$dbName", $dbUser, $dbPassword);
    } catch (PDOException $e) {
        return null;
    }
}

function createAddressString(array $order)
{
    return
        " ул. " . $order['street'] .
        " дом " . $order['house'] . $order['part'] .
        (!empty($order['floor']) ? " этаж " . $order['floor'] : "") .
        " кв. " . $order['apartment'];
}

function addOrder(array &$order)
{
    $pdo = connectToSql();
    if (!$pdo) {
        echo "База данных недоступна!";
        die;
    }

    $pdo->beginTransaction();
    $client = getClientByEmail($pdo, $order['email']);

    if (empty($client)) {
        $query = "insert into clients (name, email, phone, num_orders) values (:name, :email, :phone, num_orders + 1)";
        $st = $pdo->prepare($query);
        $st->bindParam(':name', $order['name']);
        $st->bindParam(':email', $order['email']);
        $st->bindParam(':phone', $order['phone']);
        $res = $st->execute();
        if (!$res) {
            print_r($pdo->errorInfo());
            $pdo->rollBack();
            die;
        }
        $order['_id_client'] = $pdo->lastInsertId();
        $order['_num_orders'] = 1;
    } else {
        $order['_id_client'] = $client['id'];
        $order['_num_orders'] = $client['num_orders'] + 1;
        $query = "update clients set num_orders = num_orders + 1 where id = {$order['_id_client']}";
        $res = $pdo->exec($query);
        if (!$res) {
            print_r($pdo->errorInfo());
            $pdo->rollBack();
            die;
        }
    }


// записываем заказ в БД
    $query = "insert into orders_address (street, house, part, floor, apartment)
                values (:street, :house, :part, :floor, :apartment)";
    $st = $pdo->prepare($query);
    $st->bindParam(':street', $order['street']);
    $st->bindParam(':house', $order['house'], PDO::PARAM_INT, 6);
    $st->bindParam(':part', $order['part']);
    $st->bindParam(':floor', $order['floor']);
    $st->bindParam(':apartment', $order['apartment']);
    $res = $st->execute();
    if (!$res) {
        print_r($pdo->errorInfo());
        $pdo->rollBack();
        die;
    }
    $order['_id_address'] = $pdo->lastInsertId();

    $query = "insert into orders (id_clients, id_address, order_date) values (:id_clients, :id_address, :order_date)";
    $st = $pdo->prepare($query);
    $st->bindParam(':id_clients', $order['_id_client']);
    $st->bindParam(':id_address', $order['_id_address']);
    $st->bindValue(':order_date', date("Y-m-d H:i:s"));
    $res = $st->execute();
    if (!$res) {
        print_r($pdo->errorInfo());
        $pdo->rollBack();
        die;
    }
    $order['_id_order'] = $pdo->lastInsertId();

    $pdo->commit();
    return true;
}
