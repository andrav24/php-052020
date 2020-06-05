<?php
declare(strict_types=1);

const SET_OF_NAMES = ["Андрей", "Валерий", "Мария", "Александр", "Анастасия"];

/**
 * Создание пользователя
 * @param int $userId
 * @return array
 */
function createUser(int $userId): array
{
    return array(
        'id' => $userId,
        'name' => SET_OF_NAMES[mt_rand(0,count(SET_OF_NAMES) - 1)],
        'age' => mt_rand(18, 45));
}

/**
 * Подсчет кол-ва каждого имени в массиве пользователей
 * @param array $users
 * @return array
 */
function amountOfUserNames(array $users): array
{
    $names = array_column($users, 'name');
    return array_count_values($names);
}

/**
 * Подсчет среднего возраста пользователей
 * @param array $users
 * @return float
 */
function averageUserAge(array $users): float
{
    return (float) array_sum(array_column($users, 'age')) / count($users);
}
