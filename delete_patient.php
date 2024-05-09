<?php
// Include the database connection file
require_once "dbconn.php";

// Initialize response array
$response = array();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the patient_id from the POST request
    $patientId = $_POST["patient_id"];

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("DELETE FROM patient_table WHERE patient_id = ?");
    $stmt->bind_param("s", $patientId);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Set the response status to true
        $response['status'] = true;
        $response['message'] = 'Patient deleted successfully';
    } else {
        // Set the response status to false
        $response['status'] = false;
        $response['message'] = 'Failed to delete patient';
    }

    // Close the statement
    $stmt->close();
} else {
    // Set the response status to false for invalid request method
    $response['status'] = false;
    $response['message'] = "Invalid request method";
}

// Return the response in JSON format
echo json_encode($response);

// Close the connection
$conn->close();
?>
