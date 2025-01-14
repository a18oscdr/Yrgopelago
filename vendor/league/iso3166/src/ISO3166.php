<?php 

use league\iso3166\src\ISO3166;
$calendar = new ISO3166();
$year = 2025;
$month = 1; // January

$daysInMonth = $calendar->daysInMonth($month, $year);

for ($day = 1; $day <= $daysInMonth; $day++) {
    // Display the day of the month
    echo $day . ' ';
}

?>