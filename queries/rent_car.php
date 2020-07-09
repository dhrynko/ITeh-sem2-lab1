<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="add_rent.php" method="post">
    <select name="car">
        <?php
        require "../db.php";

        $startDate = $_GET['rent-start-date'];
        $endDate = $_GET['rent-end-date'];

        $takenCarsQuery = "SELECT * FROM rent
              WHERE :start_date 
              BETWEEN Date_start AND Date_end 
              OR :end_date
              BETWEEN Date_start AND Date_end";

        $getTakenCarsQuery = $db->prepare($takenCarsQuery);
        $getTakenCarsQuery->execute(array(':start_date' => $startDate, ':end_date' => $endDate));

        $takenCars = array();
        while ($result = $getTakenCarsQuery->fetch(PDO::FETCH_ASSOC)) {
            array_push($takenCars, $result['FID_Car']);
        }

        $inTakenCars = '';
        foreach ($takenCars as $i => $item) {
            $value = $item;
            $inTakenCars .= "$value,";
        }

        $inTakenCars = rtrim($inTakenCars, ",");

        $carsQuery = "SELECT * FROM cars
              WHERE ID_Cars 
              NOT IN (:in_taken_cars)";

        $getQuery = $db->prepare($carsQuery);
        $getQuery->execute(array(':in_taken_cars' => $inTakenCars));

        while ($result = $getQuery->fetch(PDO::FETCH_ASSOC)) {
            $carId = $result['ID_Cars'];
            $car = $result['Name'];
            $price = $result['Price'];
            echo "<option value='$carId $startDate $endDate $price'>$car</option>";
        }

        ?>
    </select>
    <input type="submit" value="Rent">
</form>
</body>
</html>