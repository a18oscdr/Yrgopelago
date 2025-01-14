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
    <input type="submit" value="Book Room">
</form>