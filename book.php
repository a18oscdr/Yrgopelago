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

    return true;
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