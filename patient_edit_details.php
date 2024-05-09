<?php
// Include the database connection file
require_once "dbconn.php";

// Check if the request method is GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the patient_id parameter is provided
    if (isset($_GET['patient_id'])) {
        $patient_id = $_GET['patient_id'];

        // Perform the database query
        $sql = "SELECT `patient_name`, `patient_age`, `patient_email`, `patient_mobile_number` FROM `patient_table` WHERE `patient_id` = $patient_id";
        $result = $conn->query($sql);

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Fetch the data and store it in an array
            $patientData = array();
            while ($row = $result->fetch_assoc()) {
                $patientData[] = $row;
            }

            // Return the data in JSON format
            echo json_encode($patientData);
        } else {
            // No data found for the patient_id
            echo json_encode(array("message" => "No data found for patient ID: $patient_id"));
        }
    } else {
        // Patient ID parameter is missing
        echo json_encode(array("message" => "Patient ID parameter is missing"));
    }
} else {
    // Invalid request method
    echo json_encode(array("message" => "Invalid request method"));
}

// Close the connection
$conn->close();
?>
