<?php
function displayCalendar($year, $month) {
    // Get the number of days in the month
    $daysInMonth = date('t', mktime(0, 0, 0, $month, 1, $year));

    // Get the day of the week for the first day of the month
    $dayOfWeek = date('w', mktime(0, 0, 0, $month, 1, $year));

    // Display the calendar
    echo "  Su Mo Tu We Th Fr Sa\n";
    for ($i = 0; $i < $dayOfWeek; $i++) {
        echo "   ";
    }
    for ($day = 1; $day <= $daysInMonth; $day++) {
        echo sprintf("%2d ", $day);
        if (($day + $dayOfWeek - 1) % 7 == 0) {
            echo "\n";
        }
    }
}

function displayBookings($arrivalDate, $departureDate) {
    // Connect to the database
    $db = new mysqli("localhost", "username", "password", "database");

    // Get the bookings for the given date range
    $query = "SELECT * FROM bookings WHERE arrival_date <= '$departureDate' AND departure_date >= '$arrivalDate'";
    $result = $db->query($query);

    // Display the bookings
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Room " . $row["room_id"] . " booked from " . $row["arrival_date"] . " to " . $row["departure_date"] . "\n";
        }
    } else {
        echo "No bookings found for the given date range.\n";
    }
}

// Display the calendar
displayCalendar(2025, 1);

// Display the bookings
displayBookings("2025-01-01", "2025-01-31");
?>