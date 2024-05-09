<?php
// Include the database connection configuration
include("dbconn.php");

// Create an associative array to hold the API response
$response = array();

try {
    // Check if the request method is POST or GET
    if ($_SERVER["REQUEST_METHOD"] === "POST" || $_SERVER["REQUEST_METHOD"] === "GET") {
        // Get the patient_id from the request parameters
        $patient_id = $_REQUEST['patient_id'];

        // Fetch data from patient_table table by patient_id
        $selectDProfileSql = "SELECT * FROM patient_table WHERE patient_id = ?";
        $stmtSelectDProfile = $conn->prepare($selectDProfileSql);
        $stmtSelectDProfile->bind_param('s', $patient_id);
        $stmtSelectDProfile->execute();

        $result = $stmtSelectDProfile->get_result();
        if ($result->num_rows > 0) {
            // Fetch the data
            $profileData = $result->fetch_assoc();

            $response['success'] = true;
            $response['data'] = $profileData;
            $response['message'] = "Data retrieved successfully from 'patient_table' table";
        } else {
            $response['success'] = false;
            $response['message'] = "Error: Patient ID not found in 'patient_table' table";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Invalid request method";
    }
} catch (Exception $e) {
    // Handle any exceptions
    $response['success'] = false;
    $response['message'] = "Error: " . $e->getMessage();
}

// Convert the response array to JSON and echo it
header('Content-Type: application/json');
echo json_encode($response);

// Close the database connection
$conn->close();
?>
