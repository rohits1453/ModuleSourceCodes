<?php
require_once 'dbconn.php';

// Check if the request method is GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the patient_mobile_number parameter is provided
    if (isset($_GET['patient_mobile_number'])) {
        $patient_mobile_number = $_GET['patient_mobile_number'];

        // Perform the database query
        $sql = "SELECT patient_name, patient_age, patient_email, patient_mobile_number, patient_id, patient_password, patient_reenter_password FROM patient_table WHERE patient_mobile_number='$patient_mobile_number'";
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
            // No data found for the mobile number
            echo json_encode(array("message" => "No data found for mobile number: $patient_mobile_number"));
        }
    } else {
        // Mobile number parameter is missing
        echo json_encode(array("message" => "Mobile number parameter is missing"));
    }
} else {
    // Invalid request method
    echo json_encode(array("message" => "Invalid request method"));
}

// Close the connection
$conn->close();
?>
