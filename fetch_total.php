<?php
require("dbconn.php");

// Assuming you have variables for scoredValue, totalScore, and outcome
$scoredValue = $_POST['scoredValue'];
$totalScore = $_POST['totalScore'];
$outcome = $_POST['outcome'];

// Query to insert values into checkboxes_values table
$sql = "INSERT INTO `checkboxes_values` (`patient_score`, `total_score`, `outcome`, `patient_id`) 
        VALUES ('$scoredValue', '$totalScore', '$outcome', 'your_patient_id_here')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
