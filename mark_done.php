<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Get current status
    $query = $conn->query("SELECT status FROM projects WHERE id = $id");
    $row = $query->fetch_assoc();
    
    // Toggle status
    $newStatus = ($row['status'] === 'Done') ? 'Undone' : 'Done';
    
    // Update status in database
    $conn->query("UPDATE projects SET status = '$newStatus' WHERE id = $id");
}

header("Location: index.php");
exit();
?>
