<?php
// Include the database connection file
require "dbconn.php";

// Check if POST data is set
if (isset($_POST['doctor_id']) && isset($_POST['password'])) {
    // Get the POST data
    $doctor_id = $_POST['doctor_id'];
    $entered_password = $_POST['password'];

    // Get the correct password from the database
    $sql = "SELECT password FROM doctor_table WHERE doctor_id = '$doctor_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Doctor ID exists in the database
        $row = $result->fetch_assoc();
        $correct_password = $row['password'];

        // Check if the entered password matches the correct password
        if ($entered_password == $correct_password) {
            // Password is correct
            echo "success";
        } else {
            // Password is incorrect
            echo "incorrect";
        }
    } else {
        // Doctor ID not found in the database
        echo "not_found";
    }
} else {
    // Invalid request
    echo "invalid_request";
}

$conn->close(); // Close connection
?>
