<?php
require "dbconn.php"; 

// Initialize the JSON string
$jsonResponse = "";

// Check if the POST request contains the necessary data
if (isset($_POST['checkbox_id']) && isset($_POST['value']) && isset($_POST['clicked_checkbox']) && isset($_POST['patient_id'])) {
    
    $checkboxId = $_POST['checkbox_id'];
    $value = $_POST['value'];
    $clickedCheckbox = $_POST['clicked_checkbox'];
    $patientId = $_POST['patient_id'];
    
    // Prepare and bind the INSERT statement
    $stmt = $conn->prepare("INSERT INTO checkboxes_values (checkbox_id, value, clicked_checkbox, patient_id, default_total, default_total_usg) VALUES (?, ?, ?, ?, 26, 30)");
    $stmt->bind_param("ssss", $checkboxId, $value, $clickedCheckbox, $patientId);
    
    // Execute the statement
    if ($stmt->execute() === TRUE) {
        $jsonResponse .= json_encode(array("success" => true, "message" => "Checkbox data inserted successfully")) . "\n";
    } else {
        $jsonResponse .= json_encode(array("success" => false, "message" => "Error inserting checkbox data: " . $conn->error)) . "\n";
    }
    
    // Close the statement
    $stmt->close();
    
} else {
    $jsonResponse .= json_encode(array("success" => false, "message" => "Missing data")) . "\n";
}

// Update total values for each patient
$sql = "UPDATE checkboxes_values AS cv
        JOIN (
            SELECT patient_id, SUM(value) AS total
            FROM checkboxes_values
            GROUP BY patient_id
        ) AS t ON cv.patient_id = t.patient_id
        SET cv.total = t.total
        WHERE cv.patient_id = t.patient_id";
if ($conn->query($sql) === TRUE) {
    $jsonResponse .= json_encode(array("success" => true, "message" => "Total values updated successfully")) . "\n";
} else {
    $jsonResponse .= json_encode(array("success" => false, "message" => "Error updating total values: " . $conn->error)) . "\n";
}

// Select data from checkboxes_values table
$sql = "SELECT `s_no`, `checkbox_id`, `value`, `total`, `clicked_checkbox`, `patient_id` FROM `checkboxes_values`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $jsonResponse .= json_encode(array("success" => true, "data" => $row)) . "\n";
    }
} else {
    $jsonResponse .= json_encode(array("success" => false, "message" => "No data found")) . "\n";
}

// Close the connection
$conn->close();

// Output the JSON response
echo $jsonResponse;

?>
