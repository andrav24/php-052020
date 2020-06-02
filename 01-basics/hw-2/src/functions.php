<?php
declare(strict_types = 1);

function task1(array $strings, bool $flag = false): string
{
    $result = "";
    foreach ($strings as $string) {
        if ($flag) {
            $result .= $string;
        } else {
            $result .= "<p>$string</p>";
        }
    }
    return $result;
}

function task2(string $operation, ...$args)
{
    $result = 0;
    foreach ($args as $key => $val) {
        if (!is_numeric($val)) {
            $result = null;
            break;
        }

        if ($operation == "+") {
            $result += $val;
        } elseif ($operation == "-") {
            $result -= $val;
        } elseif ($operation == "*") {
            if ($key == 0) {
                $result = 1;
            } else {
                $result *= $val;
            }
        } elseif ($operation == "/") {
            if ($key == 0) {
                $result = $val;
            } elseif ($val == 0) {
                $result = null;
                break;
            } else {
                $result /= $val;
            }
        }
    }
    return $result;
}

function task3($rows, $cols)
{
    if (!is_int($rows) || !is_int($cols) || ($rows <= 0) || ($cols <= 0)) {
        trigger_error("Ошибка в параметрах. Функция принимает только положительные целые числа!");
    }

    $tableData = "";
    for ($currentRow = 1; $currentRow <= $rows; $currentRow++) {
        $rowData = "";
        for ($currentCol = 1; $currentCol <= $cols; $currentCol++) {
            $rowData .= "<td style='border:1px solid;padding:5px;'>" . ($currentRow * $currentCol) . "</td>";
        }
        $tableData .= "<tr>$rowData</tr>";
    }
    return "<table>$tableData</table>";
}

function task4(string $filename)
{
    $file = (fopen($filename, "r")) or die("Ошибка!");
    $str = "";
    while (!feof($file)) {
        $str .= fgets($file);
    }
    fclose($file);
    return $str;
}

function task5()
{

}

function task6()
{

}

function task7()
{

}

function task8()
{

}

function task9()
{

}

function task10()
{

}
