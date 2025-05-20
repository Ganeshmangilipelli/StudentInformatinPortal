<?php
session_start();
require_once 'db.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Get all events from the database
$sql = "SELECT * FROM events ORDER BY timestamp DESC";
$result = $conn->query($sql);
if (!$result) {
    die("Error executing query: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='event-box'>
            <h3>" . htmlspecialchars($row['title']) . "</h3>
            <p><strong>Description:</strong> " . htmlspecialchars($row['description']) . "</p>
            <p><strong>Time:</strong> " . $row['event_time'] . "</p>
            <p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>
            <p><strong>Guest of Honour:</strong> " . htmlspecialchars($row['guest_of_honour']) . "</p>
            <p><strong>Posted By:</strong> " . htmlspecialchars($row['created_by']) . "</p>
        </div>
        ";
    }
} else {
    echo "<p>No events available.</p>";
}
?>