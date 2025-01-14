<?php
// check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get the form data
    $room = $_POST['room'];
    $arrivalDate = $_POST['arrival_date'];
    $departureDate = $_POST['departure_date'];

    // Check if the room is available
    if (checkRoomAvailability($room, $arrivalDate, $departureDate)) {
        // Book the room
        bookRoom($room, $arrivalDate, $departureDate);
        echo "Room booked successfully!";
    } else {
        echo "Sorry, the room is not available for the selected dates.";
    }
}

/**
 * Checks if a room is available for the given dates.
 *
 * @param int $room The room number.
 * @param string $arrivalDate The arrival date.
 * @param string $departureDate The departure date.
 * @return bool Returns true if the room is available, false otherwise.
 */
function checkRoomAvailability($room, $arrivalDate, $departureDate) {
    // Connect to the database
    $db = new mysqli("localhost", "username", "password", "database");

    // Check if the room is available
    $query = "SELECT * FROM bookings WHERE room_id = '$room' AND arrival_date <= '$departureDate' AND departure_date >= '$arrivalDate'";
    $result = $db->query($query);

    // If there are any bookings that overlap with the given date range, return false
    if ($result->num_rows > 0) {
        return false;
    } else {
        return true;
    }
}

/**
 * Books a room for the given dates.
 *
 * @param int $room The room number.
 * @param string $arrivalDate The arrival date.
 * @param string $departureDate The departure date.
 * @return void
 */
function bookRoom($room, $arrivalDate, $departureDate) {

    echo "Room $room booked for $arrivalDate to $departureDate";
}
?>