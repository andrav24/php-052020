<?php

require('src/functions.php');

$arrayOfStrings = ["qq", "ww", "ee", "rr", "tt", "yy",];
echo "<b>Функция task1</b>" . "<br>" . "Результат работы:";
echo task1($arrayOfStrings), "<br>";
echo task1($arrayOfStrings, true), "<hr>";

echo task2("+", 4,5,10,6);
echo "<br>";
echo task2("/", 200,2,2.5);
echo "<hr>";

echo task3(3,3);
echo "<hr>";


/**
 *  Выведите информацию о текущей дате в формате 31.12.2016 23:59
 *  Выведите unixtime время соответствующее 24.02.2016 00:00:00.
 */

echo date("d.m.Y H:i");
echo "<br>";
echo "24.02.2016 00:00:00 is correspond with Unix time: " . mktime(0, 0, 0, 2, 24, 2016);
echo "<hr>";

/**
 * Дана строка: “Карл у Клары украл Кораллы”. Удалить из этой строки все заглавные буквы “К”.
 * Дана строка: “Две бутылки лимонада”. Заменить “Две”, на “Три”.
 */

$str = "Карл у Клары украл Кораллы";
$strSearchFor = "К";
$replace = "";
echo str_replace($strSearchFor, $replace, $str);
echo "<br>";
$str = "Две бутылки лимонада";
$strSearchFor = "Две";
$replace = "Три";
echo str_replace($strSearchFor, $replace, $str);
echo "<hr>";
/**
 * Создайте файл test.txt средствами PHP. Поместите в него текст - “Hello again!”
 * Напишите функцию, которая будет принимать имя файла, открывать файл и выводить содержимое на экран.
*/

$str = "Hello again!";
$filename = "test.txt";
$file = (fopen($filename, "w+")) or die("Ошибка!");
fputs($file, $str);
fclose($file);
echo task4($filename);
echo "<hr>";


task5();
task7();
task8();
task9();
task10();
