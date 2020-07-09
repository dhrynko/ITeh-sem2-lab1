<?php
require "../db.php";

$date = $_GET['rent-income-date'];

$query = "SELECT COALESCE(SUM(DISTINCT Cost), 0)
          FROM rent
          WHERE Date_end < :date";

$getQuery = $db->prepare($query);
$getQuery->execute(array(':date' => $date));

while ($result = $getQuery->fetch(PDO::FETCH_ASSOC)) {
    $totalCost = round($result['COALESCE(SUM(DISTINCT Cost), 0)'],1 );
    echo "<h2>Total Rent Income</h2>";
    echo "<p>$totalCost</p>";
}
