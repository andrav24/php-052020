<?php

// параметры подключения
$user = 'user1';
$pass = 'user1';
$dbname = 'burgers';

// подключение к бд
try {
    $pdo = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
} catch (PDOException $e) {
    echo $e->getMessage();
    die;
}
$name = 'credit card 2';
$email = 'test@test.com';
$phone = '+7 (555) 913 55 22';

//$query = "insert into clients (name, email, phone)  values ('$name', '$email', '$phone');";
$query = "insert into clients (name) values ('$name');";
echo $query;
$res = $pdo->exec($query);
$res = null;

$query = "select * from clients";
foreach ($pdo->query($query) as $row) {
    echo "<pre>" . var_dump($row) . "</pre>";
}