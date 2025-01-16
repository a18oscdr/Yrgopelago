<?php
// Any existing PHP code here...
?>

<html>
  <head>
    <title>Booking Form</title>
  </head>
  <body>
    <h1>Book a Room</h1>
    <form action="book.php" method="post">
      <label for="room">Room:</label>
      <select id="room" name="room">
        <option value="1">Room 1</option>
        <option value="2">Room 2</option>
        <option value="3">Room 3</option>
      </select>
      <br>
      <label for="arrival_date">Arrival Date:</label>
      <input type="date" id="arrival_date" name="arrival_date">
      <br>
      <label for="departure_date">Departure Date:</label>
      <input type="date" id="departure_date" name="departure_date">
      <br>
      <label for="amenities">Amenities:</label>
      <input type="checkbox" id="coffeemaker" name="amenities[]" value="coffeemaker">
      <label for="coffeemaker">Coffeemaker</label>
      <br>
      <input type="checkbox" id="ps5" name="amenities[]" value="ps5">
      <label for="ps5">PS5</label>
      <br>
      <input type="checkbox" id="minibar" name="amenities[]" value="minibar">
      <label for="minibar">Minibar</label>
      <br>
      <input type="submit" value="Book Room">
    </form>
  </body>
</html>