<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $start_date = $conn->real_escape_string($_POST['start_date']);
    $end_date = $conn->real_escape_string($_POST['end_date']);
    $scope = $conn->real_escape_string($_POST['scope']);
    
    // Default status
    $status = 'Pending';
    
    // Validate that the end date is greater than the start date
    if (strtotime($end_date) <= strtotime($start_date)) {
        echo "<div style='color: white; background-color: red; padding: 10px; border-radius: 5px; font-weight: bold; text-align: center; width: 50%; margin: 20px auto;'>Error: End date must be greater than start date.</div>";
        echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 3000);</script>";
    } else {
        // Insert into database
        $sql = "INSERT INTO projects (name, start_date, end_date, scope, status) VALUES ('$name', '$start_date', '$end_date', '$scope', '$status')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<div style='color: white; background-color: green; padding: 10px; border-radius: 5px; font-weight: bold; text-align: center; width: 50%; margin: 20px auto;'>Project added successfully!</div>";
            echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 3000);</script>";
        } else {
            echo "<div style='color: white; background-color: red; padding: 10px; border-radius: 5px; font-weight: bold; text-align: center; width: 50%; margin: 20px auto;'>Error: " . $conn->error . "</div>";
            echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 3000);</script>";
        }
    }
}
?>
