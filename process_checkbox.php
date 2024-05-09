<?php

require "dbconn.php"; 

// Check if the patient_id is set in the POST request
if(isset($_POST['patient_id'])) {
    $patient_id = $_POST['patient_id'];

    // Initialize the JSON string
    $jsonResponse = "";

    // Check if the patient_id exists in the patient_table
    $checkQuery = "SELECT * FROM patient_table WHERE patient_id = '$patient_id'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Patient_id exists, proceed with inserting data into checkboxes_values
        $s_no = $_POST['s_no'];
        $Scoredvalue = $_POST['Scoredvalue'];
        $total = $_POST['total'];

        $insertQuery = "INSERT INTO checkboxes_values (s_no, Scoredvalue, total, patient_id) VALUES ('$s_no', '$Scoredvalue', '$total', '$patient_id')";
        echo "Insert Query: " . $insertQuery; // Debug output

        if ($conn->query($insertQuery) === TRUE) {
            echo json_encode(array("status" => "success", "message" => "Data inserted successfully", "success" => true));
        } else {
            echo json_encode(array("status" => "error", "message" => "Error inserting data: " . $conn->error, "success" => false));
        }
    } else {
        // Patient_id does not exist in the patient_table
        echo json_encode(array("status" => "error", "message" => "Patient_id does not exist", "success" => false));
    }
} else {
    // Patient_id is not set in the POST request
    echo json_encode(array("status" => "error", "message" => "Patient_id is not set", "success" => false));
}

// Close the database connection
$conn->close();
?>
