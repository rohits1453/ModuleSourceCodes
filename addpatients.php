<?php
// Include the database connection file
require "dbconn.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required keys are set and not empty
    if (
        isset($_POST["patient_name"], $_POST["patient_age"], $_POST["patient_email"], $_POST["patient_mobile_number"], $_POST["patient_id"], $_POST["patient_gender"]) &&
        !empty($_POST["patient_name"]) && !empty($_POST["patient_age"]) && !empty($_POST["patient_email"]) && !empty($_POST["patient_mobile_number"]) && !empty($_POST["patient_id"]) && !empty($_POST["patient_gender"])
    ) {
        // Retrieve form data
        $patientName = $_POST["patient_name"];
        $patientAge = $_POST["patient_age"];
        $email = $_POST["patient_email"];
        $mobileNumber = $_POST["patient_mobile_number"];
        $patientId = $_POST["patient_id"];
        $gender = $_POST["patient_gender"];

        // Perform the MySQL query to insert data
        $stmt = $conn->prepare("INSERT INTO `patient_table` (`patient_name`, `patient_age`, `patient_email`, `patient_mobile_number`, `patient_id`, `patient_gender`) VALUES (?, ?, ?, ?, ?, ?)");

        // Bind parameters
        $stmt->bind_param("sissss", $patientName, $patientAge, $email, $mobileNumber, $patientId, $gender);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Record inserted successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: Missing or empty required form data";
    }
} else {
    echo "Error: Invalid request method";
}

// Close connection
$conn->close();
?>
