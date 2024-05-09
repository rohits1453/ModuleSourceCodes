<?php
require "dbconn.php";

// Set predefined doctor ID and password for testing
$expectedDoctorId = "1453";
$expectedPassword = "welcome";

// Get the raw POST data as a string
$json_data = file_get_contents("php://input");

// Decode the JSON data into an associative array
$request_data = json_decode($json_data, true);

// Get the username and password from the decoded JSON data
$doctor_id = $request_data['doctor_id'];
$password = $request_data['password'];

$response = array();

// Check if the provided credentials match the expected values
if ($doctor_id == $expectedDoctorId && $password == $expectedPassword) {
    // Assuming successful login, you can query the database here if needed

    // Create a response indicating successful login
    $response['status'] = "Success";
    $response['message'] = "Doctor Login successful!";
    $response['doctor_name'] = "Test Doctor";  // Provide the actual doctor name if needed
} else {
    // Create a response indicating invalid username or password
    $response['status'] = "error";
    $response['message'] = "Invalid username or password";
}

// Return the JSON-encoded response
echo json_encode($response);

// Note: In a production environment, you would perform database queries to validate credentials.
// This example assumes a static set of credentials for testing purposes.

// Close the database connection
$conn->close();
?>
