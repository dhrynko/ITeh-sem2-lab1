<?php
require "db.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles/style.css">
    <title>Car Rent SQL</title>
</head>
<body>
<div class="block">
    <div>
        <h1>Rent Income By Date</h1>
        <p>Choose date</p>
    </div>
    <form action="queries/total_rent.php">
        <input name="rent-income-date" type="date" value="2014-08-12" min="2014-01-11" max="2021-12-31">
        <input type="submit" value="Show">
    </form>
    <br>
    <br>
    <div>
        <h1>Cars By Vendor</h1>
        <p>Choose vendor</p>
    </div>
    <form action="queries/cars_by_vendor.php">
        <select name="vendor">
            <?php
            $query = "SELECT * FROM vendors";

            $getQuery = $db->prepare($query);
            $getQuery->execute();

            while ($result = $getQuery->fetch(PDO::FETCH_ASSOC)) {
                $vendorId = $result['ID_Vendors'];
                $vendor = $result['Name'];
                echo "<option value='$vendorId'>$vendor</option>";
            }
            ?>
        </select>
        <input type="submit" value="Show">
    </form>
    <br>
    <br>
    <div>
        <h1>Free Cars By Date</h1>
        <p>Choose date</p>
    </div>
    <form action="queries/free_cars_by_date.php">
        <input name="free-cars-date" type="date" value="2014-08-12" min="2014-01-11" max="2021-12-31">
        <input type="submit" value="Show">
    </form>
</div>
<div class="block">
    <div>
        <h1>Rent Car</h1>
        <p>Choose start date</p>
    </div>
    <form action="queries/rent_car.php">
        <input name="rent-start-date" type="date" value="2014-08-12" min="2014-01-11" max="2021-12-31">
    <p>Choose end date</p>
        <input name="rent-end-date" type="date" value="2014-08-12" min="2014-01-11" max="2021-12-31">
    <p>Choose free car</p>
        <input type="submit" value="Choose car">
    </form>
    <br>
    <br>
</div>
<div class="block">
    <div>
        <h1>Change Mileage</h1>
        <p>Choose car</p>
    </div>
    <form action="queries/change_mileage.php">
        <select name="car-update">
            <?php
            $query = "SELECT * FROM cars";

            $getQuery = $db->prepare($query);
            $getQuery->execute();

            while ($result = $getQuery->fetch(PDO::FETCH_ASSOC)) {
                $carId = $result['ID_Cars'];
                $car = $result['Name'];
                echo "<option value='$carId'>$car</option>";
            }
            ?>
        </select>
        <input type="text" value="0" name="mileage-diff">
        <input type="submit" value="Change">
    </form>
    <br>
    <br>
</div>
<div></div>
</body>
</html>


