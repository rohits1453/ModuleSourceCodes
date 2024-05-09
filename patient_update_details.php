<?php
// Include the database connection file
require_once "dbconn.php";

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the POST request
    $patientName = $_POST["patient_name"];
    $patientAge = $_POST["patient_age"];
    $patientEmail = $_POST["patient_email"];
    $patientMobileNumber = $_POST["patient_mobile_number"];
    

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("UPDATE patient_table SET patient_age=?, patient_email=?, patient_mobile_number=? WHERE patient_name=?");
    $stmt->bind_param("ssss", $patientAge, $patientEmail, $patientMobileNumber, $patientName);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Return success message
        echo json_encode(array("status" => "success"));
    } else {
        // Return error message
        echo json_encode(array("status" => "error"));
    }

    // Close the statement
    $stmt->close();
} else {
    // Return error message for invalid request method
    echo json_encode(array("status" => "error", "message" => "Invalid request method"));
}

// Close the connection
$conn->close();
?>
