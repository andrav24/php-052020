<?php

require_once '../src/functions.php';

$users = [];
for ($i = 0; $i < 50; $i++) {
    $lastIndex = empty($users) ? 0 : (int) array_key_last($users) + 1;
    $users[] = createUser($lastIndex);
}

file_put_contents("users.json", json_encode($users));
$users = json_decode(file_get_contents("users.json"), true);

echo 'Кол-во имен: <pre>' . print_r(amountOfUserNames($users), 1) . '</pre>';
echo "Средний возраст: " . number_format(averageUserAge($users), 1);
