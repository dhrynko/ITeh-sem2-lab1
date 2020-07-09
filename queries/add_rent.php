<?php
require "../db.php";

$car = $_POST['car'];
$carInfo = explode(" ", $car);

$carsQuery = "INSERT INTO rent (FID_Car, Date_start, Time_start, Date_end, Time_end, Cost)
              VALUES (:car_id, :start_date, '12:00:00', :end_date, '12:00:00', :cost)";

$getQuery = $db->prepare($carsQuery);
$getQuery->execute(array(':car_id' => $carInfo[0], ':start_date' => $carInfo[1],
    ':end_date' => $carInfo[2], ':cost' => $carInfo[3]));

echo "<p>Rented car $carInfo[0] from $carInfo[1] to $carInfo[2]</p>";

?>