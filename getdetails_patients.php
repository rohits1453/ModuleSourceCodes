<?php
require('dbconn.php');

$sql = "SELECT `patient_id`, `patient_name`, `patient_age`, `patient_gender` FROM `patient_table` WHERE 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Array to hold patient data
    $patients = array();

    // Fetch data from each row and add to the patients array
    while($row = $result->fetch_assoc()) {
        $patient = array(
            'patient_id' => $row["patient_id"],
            'patient_name' => $row["patient_name"],
            'patient_age' => $row["patient_age"],
            'patient_gender' => $row["patient_gender"]
        );
        $patients[] = $patient;
    }

    // Send JSON response
    header('Content-Type: application/json');
    echo json_encode($patients);
} else {
    echo "0 results";
}
$conn->close();
?>
