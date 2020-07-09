<?php
require "../db.php";

$vendor = $_GET['vendor'];

$query = "SELECT * FROM cars WHERE FID_Vendors = :vendor";

$getQuery = $db->prepare($query);
$getQuery->execute(array(':vendor' => $vendor));

while ($result = $getQuery->fetch(PDO::FETCH_BOTH)) {
    $car = $result['Name'];
    echo "<li>$car</li>";
}
