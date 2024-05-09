<?php

// Include your database connection file
require "dbconn.php";

// Get the raw POST data as a string
$json_data = file_get_contents("php://input");

// Decode the JSON data into an associative array
$request_data = json_decode($json_data, true);

// Check if the required field 'mobile_number' is present in the JSON data
if (isset($request_data['mobile_number'])) {
    // Get the mobile number from the decoded JSON data
    $mobile_number = $request_data['mobile_number'];

    // Set the default password to "welcome" if 'patient_password' is not provided
    $patient_password = isset($request_data['patient_password']) ? $request_data['patient_password'] : 'welcome';

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO patient_table (patient_id, patient_password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $mobile_number, $patient_password);

    $response = array();

    if ($stmt->execute()) {
        $response['status'] = "Success";
        $response['message'] = "Patient registration successful!";
        echo json_encode($response);
    } else {
        $response['status'] = "error";
        $response['message'] = "Failed to register patient";
        echo json_encode($response);
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Invalid or incomplete data in the request
    $response['status'] = "error";
    $response['message'] = "Invalid or incomplete data in the request";
    echo json_encode($response);
}

// Close the database connection
$conn->close();

?>
