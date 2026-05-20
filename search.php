<?php
include('../config/db.php');

$query = $_GET['q'];

$sql = "SELECT * FROM events 
        WHERE title LIKE '%$query%' 
        OR category LIKE '%$query%' 
        OR location LIKE '%$query%'";

$result = $conn->query($sql);

$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}

echo json_encode($events);
?>