<?php
// Include the database connection file
require_once 'dbconn.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the POST data
    $patientData = $_POST["patient_id"];

    // Create a connection to the database
    $conn = createConnection();

    // Check connection
    if ($conn === false) {
        die("Connection failed");
    }

    // Prepare and bind the INSERT statement
    $stmt = $conn->prepare("INSERT INTO patient_table (patient_id) VALUES (?)");
    $stmt->bind_param("s", $patientData);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "Patient data stored successfully";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
} else {
    // Return an error message if the request method is not POST
    echo "Invalid request method";
}
?>
