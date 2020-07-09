<?php
require "../db.php";

$carId = $_GET['car-update'];
$mileage = $_GET['mileage-diff'];

$query = "UPDATE cars
          SET Race = Race + :mileage
          WHERE ID_Cars = :car_id";

$getQuery = $db->prepare($query);
$getQuery->execute(array(':mileage' => $mileage, ':car_id' => $carId,));

echo "<p>Added mileage</p>";