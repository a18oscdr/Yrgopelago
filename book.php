<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $room = $_POST['room'];
    $arrivalDate = $_POST['arrival_date'];
    $departureDate = $_POST['departure_date'];
    $amenities = $_POST['amenities'];

    // Check if the room is available
    if (checkRoomAvailability($room, $arrivalDate, $departureDate)) {
        // Book the room
        bookRoom($room, $arrivalDate, $departureDate, $amenities);
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
 * @param array $amenities The selected amenities.
 * @return void
 */
function bookRoom($room, $arrivalDate, $departureDate, $amenities) {
    // Connect to the database
    $db = new mysqli("localhost", "username", "password", "database");

    // Insert a new booking into the database
    $query = "INSERT INTO bookings (room_id, arrival_date, departure_date) VALUES ('$room', '$arrivalDate', '$departureDate')";
    $db->query($query);

    // Insert the selected amenities into the database
    foreach ($amenities as $amenity) {
        $query = "INSERT INTO amenities (booking_id, amenity) VALUES (LAST_INSERT_ID(), '$amenity')";
        $db->query($query);
    }
        // Generate the JSON response
        $response = array(
            "island" => "Main island",
            "hotel" => "Centralhotellet",
            "arrival_date" => $arrivalDate,
            "departure_date" => $departureDate,
            "total_cost" => calculateTotalCost($room, $arrivalDate, $departureDate, $amenities),
            "stars" => 3,
            "features" => array(
                array("name" => "sauna", "cost" => 2)
            ),
            "additional_info" => array(
                "greeting" => "Thank you for choosing Centralhotellet",
                "imageUrl" => "https://upload.wikimedia.org/wikipedia/commons/e/e2/Hotel_Boscolo_Exedra_Nice.jpg"
            )
        );
    
        // Send the JSON response back to the user
        header('Content-Type: application/json');
        echo json_encode($response);

        function calculateTotalCost($room, $arrivalDate, $departureDate, $amenities) {
            // Connect to the database
            $db = new mysqli("localhost", "your_username", "your_password", "your_database_name");
        
            // Calculate the number of nights
            $arrivalTimestamp = strtotime($arrivalDate);
            $departureTimestamp = strtotime($departureDate);
            $nights = ceil(($departureTimestamp - $arrivalTimestamp) / (60 * 60 * 24));
        
            // Get the room price from the database
            $query = "SELECT price FROM rooms WHERE room_id = '$room'";
            $result = $db->query($query);
            $row = $result->fetch_assoc();
            $roomPrice = $row['price'];
        
            // Calculate the total cost
            $totalCost = $roomPrice * $nights;
        
            // Add the cost of the selected amenities
            foreach ($amenities as $amenity) {
                $query = "SELECT cost FROM amenities WHERE amenity = '$amenity'";
                $result = $db->query($query);
                $row = $result->fetch_assoc();
                $amenityCost = $row['cost'];
                $totalCost += $amenityCost;
            }
        
            return $totalCost;
    }
}
?>