<?php
$bmv = [
    "model" => "X5",
    "speed" => 120,
    "doors" => 5,
    "year" => "2015",
    ];
$toyota = [
    "model" => "Corola",
    "speed" => 130,
    "doors" => 5,
    "year" => "2016",
];
$opel = [
    "model" => "Astra",
    "speed" => 120,
    "doors" => 4,
    "year" => "2012",
];

$auto = [];
$auto["bmv"] = $bmv;
$auto["toyota"] = $toyota;
$auto["opel"] = $opel;
foreach ($auto as $k => $v) {
    echo "CAR $k<br/>";
    echo "{$v['model']} {$v['speed']} {$v['doors']} {$v['year']}<br/><br/>";
}
