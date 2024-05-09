<?php
require "dbconn.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    // Get the JSON data from the request body
    $json_data = file_get_contents("php://input");

    // Decode the JSON data
    $data = json_decode($json_data, true);


// Check connection
if ($conn->connect_error) {
    $response = array('status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error);
} else {
    // Values to be inserted from POST request
    $gender_a = $data['gender_a'];
    $age_a = $data['age_a'];
    $symptoms = $data['symptoms'];
    $signs = $data['signs'];
    $radiological_investigation = $data['radiological_investigation'];
    $total = $data['total'];
    $total_without_usg = $data['total_without_usg'];
    $score_with_usg = $data['score_with_usg'];
    $score_without_usg = $data['score_without_usg'];

    // SQL query
    $sql = "INSERT INTO score( `gender_a`, `age_a`, `symptoms`, `signs`, `radiological_investigation`, `total`, `total_without_usg`, `score_with_usg`, `score_without_usg`) 
            VALUES ('$gender_a','$age_a','$symptoms','$signs','$radiological_investigation','$total','$total_without_usg','$score_with_usg','$score_without_usg')";

    // Execute query
    if ($conn->query($sql) === TRUE) {
        $response = array('status' => 'success', 'message' => 'Record added successfully');
    } else {
        $response = array('status' => 'error', 'message' => 'Error: ' . $sql . '<br>' . $conn->error);
    }
}

// Set JSON headers
header('Content-Type: application/json');

// Convert response to JSON and echo it
echo json_encode($response);

// Close connection
$conn->close();
?>
