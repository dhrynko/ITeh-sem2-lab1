<?php
require "../db.php";

$date = $_GET['free-cars-date'];

$takenCarsQuery = "SELECT * FROM rent
              WHERE :date 
              BETWEEN Date_start AND Date_end";

$getTakenCarsQuery = $db->prepare($takenCarsQuery);
$getTakenCarsQuery->execute(array(':date' => $date));

$takenCars = array();
while ($result = $getTakenCarsQuery->fetch(PDO::FETCH_ASSOC)) {
    array_push($takenCars, $result['FID_Car']);
}

$inTakenCars = '';
foreach ($takenCars as $i => $item)
{
    $value = $item;
    $inTakenCars .= "$value,";
}

$inTakenCars = rtrim($inTakenCars,",");

$carsQuery = "SELECT * FROM cars
              WHERE ID_Cars 
              NOT IN (:in_taken_cars)";

$getQuery = $db->prepare($carsQuery);
$getQuery->execute(array(':in_taken_cars' => $inTakenCars));

while ($result = $getQuery->fetch(PDO::FETCH_ASSOC)) {
    $carName = $result['Name'];
    echo "<p>$carName</p>";
}
