<?php

require_once '../src/functions.php';

date_default_timezone_set("Europe/Moscow");

$order = [];
$order['name'] = trim($_POST['name']);
$order['email'] = trim($_POST['email']);
$order['phone'] = trim($_POST['phone']);
$order['street'] = trim($_POST['street']);
$order['house'] = trim($_POST['home']);
$order['part'] = trim($_POST['part']);
$order['apartment'] = trim($_POST['appt']);
$order['floor'] = trim($_POST['floor']);

// проверка переданных параметров заказа на валидность
if (!checkOrder($order)) {
    echo "Необходимо заполнить все обязательные поля!";
    die;
}

if (addOrder($order)) {
    echo "Спасибо, ваш заказ будет доставлен по адресу: \"" . createAddressString($order) . "\"" . "<br>";
    echo "Номер вашего заказа: #{$order['_id_order']}" . "<br>";
    echo "Это ваш {$order['_num_orders']} заказ!";
}
