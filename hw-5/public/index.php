<?php

/*
 * в этом файле находятся константы с параметрами подключения к базе и паролем от почты.
 * Пример config-файла - ../src/fakeConfig.php
 */
require "../config/config.php";
require "../src/init.php";

$parts = explode('/', $_SERVER['REQUEST_URI']);
$action = $parts[1];

switch ($action) {
    case 'mail':
        include "../src/mail.php";
        die;
    case 'send-mail':
        include "../src/mail_handler.php";
        die;
    case 'image':
        include "../src/image.php";
        die;
    case 'send-image':
        include "../src/image.php";
        die;
    case 'twig':
        include "../src/twig.php";
        die;
}

include "../src/start.php";
