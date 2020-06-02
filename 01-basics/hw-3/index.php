<?php

$users = [];
$names = ["Андрей", "Валерий", "Мария", "Александр", "Анастасия"];
//$names = ["Andrey", "Valera", "Masha", "Sasha", "Nastya"];
for ($i = 0; $i < 50; $i++) {
    $users[] = [];
    $lastIndex = array_key_last($users);
    $users[$lastIndex]['id'] = $lastIndex;
    $users[$lastIndex]['name'] = $names[mt_rand(0,4)];
    $users[$lastIndex]['age'] = mt_rand(18, 45);
}

// сериализуем в json и записываем в файл
$usersJson = json_encode($users);
$users = null;
if (!file_put_contents("users.json", $usersJson)) {
    echo "ERROR: blabala";
}

// считываем из файла и преобразуем в массив
$strFromJson = file_get_contents("users.json");
$users = json_decode($strFromJson, true);

// считаем сколько каждого имени в массиве
$names = null;
$names = array_column($users, 'name');
$amountOfNames = array_count_values($names);
echo 'Кол-во имен: <pre>' . print_r($amountOfNames, 1) . '</pre>'; // распечатываем рез-т*/

// считаем средний возраст в массиве пользователей
$midOfAges = (float) array_sum(array_column($users, 'age')) / count($users);
echo "Средний возраст: " . number_format($midOfAges, 1);