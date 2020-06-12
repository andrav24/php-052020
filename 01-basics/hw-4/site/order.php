<?php

spl_autoload_register(function ($className) {
    require "../class/$className.php";
});

$order['distance'] = (int) $_POST['distance'];
$order['duration'] = (int) $_POST['duration'];
$order['tariff'] = $_POST['tariff'];
$order['service-gps'] = (bool) ($_POST['service-gps'] ?? false);
$order['service-driver'] = (bool) ($_POST['service-driver'] ?? false);

$moveInfo = new MoveInfo();

switch ($order['tariff']) {
    case 'basic':
        $totalTariff = new BasicTariff(10, 3);
        break;
    case 'hourly':
        $totalTariff = new HourlyTariff(20, 200, 60);
        break;
    case 'student':
        $totalTariff = new StudentTariff(4, 1);
        break;
}

if ($order['service-gps']) {
    $totalTariff = new GPSService($totalTariff,15, 60);
}

if ($order['service-driver']) {
    $totalTariff = new DriverService($totalTariff, 100);
}

echo "{$totalTariff->getDescription($moveInfo)}<br><br>";
echo "Общая сумма: {$totalTariff->cost($moveInfo)} руб.";
